<?php

namespace MyApp\Model;

class User extends \MyApp\Model {

  public function create($values) {
    $stmt = $this->db->prepare("insert into users (surname, givenname, email, password, created_date, modified_date) values (:surname, :givenname, :email, :password, now(), now())");
    $res = $stmt->execute([
      ':surname' => $values['surname'],
      ':givenname' => $values['givenname'],
      ':email' => $values['email'],
      ':password' => password_hash($values['password'], PASSWORD_DEFAULT)
    ]);

    $lastInsertId = $this->db->lastInsertId();
    
    $stmt2 = $this->db->query("select id, surname, givenname, email, password from users where id =" . $lastInsertId);

    $stmt2->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt2->fetch();
    error_log('DB送信完了');

    if ($res === false) {
      throw new \MyApp\Exception\DuplicateEmail();
    }
    return $user;
  }

  public function login($values) {
    $stmt = $this->db->prepare("select * from users where email = :email");
    $res = $stmt->execute([
      ':email' => $values['email']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();

    if (empty($user)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    if (!password_verify($values['password'], $user->password)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }
    return $user;
  }

  public function cancel($values) {

    $stmt = $this->db->prepare("update users set delete_flg = 1 where email = :email");
    $res = $stmt->execute([
      ':email' => $values['email'],
    ]);

    if ($res === false) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    if (!password_verify($values['password'], $_SESSION['me']->password)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }
    return;
  }
}