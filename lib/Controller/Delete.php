<?php

namespace MyApp\Controller;

class Delete extends \MyApp\Controller {

  public function run() {
    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/Corange/public_html/index.php');
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      track('POST送信がありました');
      $this->postProcess();
    }
  }

  protected function postProcess() {
    try {
      track('バリデーション開始');
      $this->_validate();
    } catch (\MyApp\Exception\EmptyPost $e) {
      $this->setErrors('common', $e->getMessage());
    } catch (\MyApp\Exception\InvalidEmail $e) {
      $this->setErrors('email', $e->getMessage());
    } catch (\MyApp\Exception\HalfPassword $e) {
      $this->setErrors('password', $e->getMessage());
    } catch (\MyApp\Exception\ConfirmTerms $e) {
      $this->setErrors('agree', $e->getMessage());
    }

    //入力保持
    $this->setValues($_POST);

    if ($this->hasError()) {
      track('入力エラー有');
      return;
    } else {
      try {
        track('バリデーションクリア');
        track('退会処理開始');
        $userModel = new \MyApp\Model\User();
        $userModel->delete(['email' => $_POST['email'],
        'password' => $_POST['password']
        ]);
      } catch (\MyApp\Exception\UnmatchEmailOrPassword $e) {
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        return;
      }

      track('退会処理完了');
      track('アンケート結果:' . "\n" . $_POST['reason'] . "\n" . $_POST['better']);

      $_SESSION = [];

      if (isset($_COOKIE[session_name()])) {
       setcookie(session_name(), '', time() - 86400, '/');
     }

      session_destroy();
      
      track('index.phpへ遷移します');
      header('Location:' . SITE_URL . '/Corange/public_html/index.php');
      exit;
    }
  }

  private function _validate() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      track('tokenが不正です');
      echo "Invalid Token!";
      exit;
    }
   //必須項目確認
   if ($_POST['email'] === '' || $_POST['password'] === '') {
     track('必須項目が未入力です');
    throw new \MyApp\Exception\EmptyPost();
  }
  //Emailの形式確認
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    track('Emailの形式ではありません');
    throw new \MyApp\Exception\InvalidEmail();
  }
  //パスワードの英数字確認
  if (!preg_match('/\A[a-zA-z0-9]+\z/', $_POST['password'])) {
    track('半角英数字ではありません');
    throw new \MyApp\Exception\HalfPassword();
  }
    //同意の有無の確認
    if (!isset($_POST['agree'])) {
      track('termsに同意していません');
      throw new \MyApp\Exception\ConfirmTerms();
    }
  }
}