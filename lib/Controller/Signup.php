<?php

namespace MyApp\Controller;

class Signup extends \MyApp\Controller {

  public function run() {
    if ($this->isLoggedIn()) {
      header('Location:' . SITE_URL);
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      track('POST送信がありました');
      $this->postProcess();
    }
  }

  protected function postProcess() {
    try {
      $this->_validate();
    } catch (\MyApp\Exception\InvalidEmail $e) {
      $this->setErrors('email', $e->getMessage());
    } catch (\MyApp\Exception\InvalidPassword $e) {
      $this->setErrors('password', $e->getMessage());
    } catch (\MyApp\Exception\ConfirmTerms $e) {
      $this->setErrors('agree', $e->getMessage());
    }

    $this->setValues('email', $_POST['email']);

    if ($this->hasError()) {
      return;
    } else {
      try {
        track('新規登録開始');
        $userModel = new \MyApp\Model\User();
        $userModel->create([
          'surname' => $_POST['surname'],
          'givenname' => $_POST['givenname'],
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ]);
      } catch (\MyApp\Exception\DuplicateEmail $e) {
        error_log('すでに登録されたemailです');
        $this->setErrors('email', $e->getMessage());
        return;
      }
      header('Location:' . SITE_URL . '/login.php');
      exit;
    }
  }

  private function _validate() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      error_log('tokenが不正です');
      echo "Invalid Token!";
      exit;
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      error_log('Emailの形式ではありません');
      throw new \MyApp\Exception\InvalidEmail();
    }
    if (!preg_match('/\A[a-zA-z0-9]+\z/', $_POST['password'])) {
      error_log('英数文字ではありません');
      throw new \MyApp\Exception\InvalidPassword();
    }
    if (!isset($_POST['agree'])) {
      error_log('termsに同意していません');
      throw new \MyApp\Exception\ConfirmTerms();
    }
  }
}