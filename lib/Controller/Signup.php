<?php

namespace MyApp\Controller;

class Signup extends \MyApp\Controller {

  //loginの有無確認
  public function run() {
    if ($this->isLoggedIn()) {
      track('【ログイン済】home.phpへ遷移します');
      header('Location:' . SITE_URL . '/Duplazy/public_html/home.php');
      exit;
    }
  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      track('POST送信がありました');
      $this->postProcess();
    }
  }

  protected function postProcess() {
    try {
      //validate開始
      $this->_validate();
    } catch (\MyApp\Exception\EmptyPost $e) {
      $this->setErrors('empty', $e->getMessage());
    } catch (\MyApp\Exception\InvalidEmail $e) {
      $this->setErrors('email', $e->getMessage());
    } catch (\MyApp\Exception\InvalidPassword $e) {
      $this->setErrors('password', $e->getMessage());
    } catch (\MyApp\Exception\ConfirmTerms $e) {
      $this->setErrors('agree', $e->getMessage());
    }

    //入力保持
    $this->setValues('surname', $_POST);
   
    if ($this->hasError()) {
      return;
    } else {
      try {
        track('新規登録開始');
        $userModel = new \MyApp\Model\User();
        $user = $userModel->create([
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

      session_regenerate_id(true);
      $_SESSION['me'] = $user;
      $_SESSION['modify'] = false;
      error_log('HOMEへ遷移します');
      header('Location:' . SITE_URL . '/Duplazy/public_html/home.php');
      exit;
    }
  }

  private function _validate() {
    //tokenの確認
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      error_log('tokenが不正です');
      echo "Invalid Token!";
      exit;
    }
    //必須項目確認
    if ($_POST['surname'] === '' || $_POST['givenname'] === '' || $_POST['email'] === '' || $_POST['password'] === '') {
      throw new \MyApp\Exception\EmptyPost();
    }
    //Emailの形式確認
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      error_log('Emailの形式ではありません');
      throw new \MyApp\Exception\InvalidEmail();
    }
    //パスワードの英数字確認
    if (!preg_match('/\A[a-zA-z0-9]+\z/', $_POST['password'])) {
      error_log('英数文字ではありません');
      throw new \MyApp\Exception\InvalidPassword();
    }
    //同意の有無の確認
    if (!isset($_POST['agree'])) {
      error_log('termsに同意していません');
      throw new \MyApp\Exception\ConfirmTerms();
    }
  }
}