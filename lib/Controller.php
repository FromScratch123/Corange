<?php

namespace Myapp;

class Controller {

  private $_errors;
  private $_values;

  public function __construct() {
    if (!isset($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
    $this->_errors = new \stdClass();
    $this->_values = new \stdClass();
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
  protected function hasError() {
    return !empty(get_object_vars($this->_errors));
  }

  protected function isLoggedIn() {
    return isset($_SESSION['me']) && !empty($_SESSION['me']);
  }
}