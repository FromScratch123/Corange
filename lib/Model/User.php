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

    if (!$res) {
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

    if (!$user) {
      track('emailに誤りがあります');
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    if (!password_verify($values['password'], $user->password)) {
      track('パスワードに誤りがあります');
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }
    return $user;
  }

  public function delete($values) {

    $stmt = $this->db->prepare("update users set delete_flg = 1 where email = :email and delete_flg = 0");
    $res = $stmt->execute([
      ':email' => $values['email']
    ]);

    if (!$res) {
      track('emailに誤りがあります');
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    if (!password_verify($values['password'], $_SESSION['me']->password)) {
      track('パスワードに誤りがあります');
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }
    return;
  }

  public function modify($array) {
    foreach ($array as $key => $value) {
      
      //入力なしの場合はスキップ
      if ($value === '') {
        continue;
      }
      $stmt = $this->db->prepare('update users set ' . $key . ' = ' . ':' . $key . ', modified_date = now() where id = :id and delete_flg = 0');
      if ($key === 'password') {
          //$keyが'password'の場合(ハッシュ化)
          $res = $stmt->execute([
            ':' . $key => password_hash($value, PASSWORD_DEFAULT),
            ':id' => $_SESSION['me']->id
          ]);
        } else {
          //$keyが'password'以外の場合
          $res = $stmt->execute([
            ':' . $key => $value,
            ':id' => $_SESSION['me']->id
          ]);
        }
    }
      if (!$res) {
        throw new \MyApp\Exception\Query();
      }
  }

  public function search($values) {
    $stmt = $this->db->prepare("select id, surname, givenname,profile_img from users where id not in (:id) and surname like :search and delete_flg = 0 or id not in (:id) and givenname like :search and delete_flg = 0 order by surname");
    $res = $stmt->execute([
      ':search' => "%" . $values['search'] . "%",
      ':id' => $values['id']
    ]);

    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
      $users = $stmt->fetchAll();
      if (!$users) {
        return false;
      } else {
        return $users;
      }
  }

  public function getAll($key, $value) {
    $stmt = $this->db->prepare("select * from users where " . $key . " = :" . $key . " and delete_flg = 0");
    if ($key === 'password') {
      //$keyが'password'の場合(ハッシュ化)
      $res = $stmt->execute([
        ':' . $key => password_hash($value, PASSWORD_DEFAULT)
      ]);
    } else {
      //$keyが'password'以外の場合
      $res = $stmt->execute([
        ':' . $key => $value
      ]);
    }
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
      $user = $stmt->fetch();
      if (!$user) {
        throw new \MyApp\Exception\Query();
      } else {
        return $user;
      }
  }

  public function getProfile($values) {
    $stmt = $this->db->prepare("select id, surname, givenname, age, prefecture, slogan, profile, profile_img, banner_img from users where id = :id and delete_flg = 0");
    $res = $stmt->execute([
      ':id' => $values['id']
    ]);

    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
      $user = $stmt->fetch();
      if (!$user) {
        throw new \MyApp\Exception\Query();
      } else {
        return $user;
      }
  }

  public function setProperties($array) {
    foreach($array as $key => $value) {
        $this->_properties->$key = $value;
      }
    return;
  }

  public function getProperties() {
    return $this->_properties;
  }


  public function resetPass ($password, $email) {
    $stmt = $this->db->prepare('update users set password = :password where email = :email and delete_flg = 0');
    $res = $stmt->execute([
      ':password' => password_hash($password, PASSWORD_DEFAULT),
      ':email' => $email
    ]);
  }

}