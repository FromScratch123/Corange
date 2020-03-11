<?php

namespace MyApp\Model;

class User extends \MyApp\Model {

  private $_properties;

  public function __construct() {
    parent::__construct();
    $this->_properties = new \stdClass();
  }

  public function create($values) {
    $stmt = $this->db->prepare("insert into users (surname, givenname, email, password, created_date, modified_date) values (:surname, :givenname, :email, :password, now(), now())");
    $res = $stmt->execute([
      ':surname' => $values['surname'],
      ':givenname' => $values['givenname'],
      ':email' => $values['email'],
      ':password' => password_hash($values['password'], PASSWORD_DEFAULT)
    ]);

    $lastInsertId = $this->db->lastInsertId();
    
    $stmt2 = $this->db->query("select * from users where id =" . $lastInsertId);

    $stmt2->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt2->fetch();
    error_log('DB送信完了');

    if ($res === false) {
      throw new \MyApp\Exception\DuplicateEmail();
    }
    return $user;
  }

  public function login($values) {
    $stmt = $this->db->prepare("select * from users where email = :email and delete_flg = 0");
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

  public function delete($values) {

    $stmt = $this->db->prepare("update users set delete_flg = 1 where email = :email and delete_flg = 0");
    $res = $stmt->execute([
      ':email' => $values['email']
    ]);

    if ($res === false) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    if (!password_verify($values['password'], $_SESSION['me']->password)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }
    return;
  }

  public function modify($array) {
      $this->setProperties($array);
      foreach($array as $key => $value) {
        if($key === 'password') {
          $stmt = $this->db->prepare('update users set ' . $key . ' = ' . ':' . $key . ', modified_date = now() where id = :id');
          $res = $stmt->execute([
            ':' . $key => password_hash($value, PASSWORD_DEFAULT),
            ':id' => $_SESSION['me']['id']
          ]);
      } else {
        $stmt = $this->db->prepare('update users set ' . $key . ' = ' . ':' . $key . ', modified_date = now() where id = :id');
            $res = $stmt->execute([
              ':' . $key => $value,
              ':id' => $_SESSION['me']['id']
            ]);
      }
           
      $modifiedStmt = $this->db->query("select * from users where id =" . $_SESSION['me']->id);
      $modifiedStmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
      $user = $modifiedStmt->fetch();
      return $user;
   }
  }

  public function setProperties($array) {
    foreach($array as $key => $value) {
      if ($key === 'password') {
        $this->_properties->$key = 
        password_hash($value, PASSWORD_DEFAULT);
      } else {
        $this->_properties->$key = $value;
      }
    }
    return;
  }

  public function getProperties() {
    return $this->_properties;
  }

}