<?php

namespace Myapp;

class Controller {

  private $_errors;
  private $_values;
  private $_rooms;
  private $_users;
  private $_clients;
  private $_friends;
  private $_messages;
  private $_myWorks;
  private $_othersWorks;
  private $_comments;
  private $_favorites;
  private $_work;
  private $_comment;
  private $_notifications;
  private $_categories;
  private $_imageFileName;
  private $_videoFileName;

  public function __construct() {
    if (!isset($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
    $this->_errors = new \stdClass();
    $this->_values = new \stdClass();
    $this->_rooms = new \stdClass();
    $this->_users = new \stdClass();
    $this->_clients = new \stdClass();
    $this->_friends = new \stdClass();
    $this->_messages = new \stdClass();
    $this->_myWorks = new \stdClass();
    $this->_othersWorks = new \stdClass();
    $this->_comments = new \stdClass();
    $this->_favorites = new \stdClass();
    $this->_work = new \stdClass();
    $this->_comment = new \stdClass();
    $this->_notifications = new \stdClass();
    $this->_categories = new \stdClass();
    $this->_imageFileName = new \stdClass();
    $this->_videoFileName = new \stdClass();
  }

  protected function setValues($array) {
    foreach($array as $key => $value) {
      if ($key === 'password') {
        $this->_values->$key = password_hash($value, PASSWORD_DEFAULT);
      } else {
        $this->_values->$key = $value;
      }
    }
  }

  // 値を配列形式でセット
  public function getValues() {
    return $this->_values;
  }

  //エラー内容を配列形式でセット
  protected function setErrors($key, $error) {
    $this->_errors->$key = $error;
  }

  public function setProperties($array, $_properties) {
    foreach($array as $key => $value) {
        $this->$_properties->$key = $value;
      }
    return;
  }

  public function getProperties($_properties) {
    return $this->$_properties;
  }

  public function getErrors($key) {
    return isset($this->_errors->$key) ? $this->_errors->$key : '';
  }

  //messageを表示
  public function getMessage($messages) {
    foreach ($messages as $key => $value) {
      $message = isset($this->_values->$key) ? $this->_values->$key : '';
    }
    return $message;
  }

  // エラーの有無を確認
  public function hasError() {
    return !empty(get_object_vars($this->_errors));
  }

  protected function isLoggedIn() {
    return isset($_SESSION['me']) && !empty($_SESSION['me']);
  }
}