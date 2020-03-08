<?php

namespace MyApp\Controller;

class Cancel extends \MyApp\Controller {

  public function run() {
    if ($this->isLoggedIn()) {
      track('【未ログイン】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/Duplazy/public_html/index.php');
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
    } catch (\MyApp\Exception\EmptyPost $e) {

      $this->setErrors('cancel', $e->getMessage());
    } 

    $this->setValues('email', $_POST['email']);

    if ($this->hasError()) {
      return;
    } else {
      try {
        $userModel = new \MyApp\Model\User();
        track('退会処理開始');
        $userModel->cancel(['email' => $_POST['email'],
        'password' => $_POST['password']
        ]);
      } catch (\MyApp\Exception\UnmatchEmailOrPassword $e) {
        track('メールアドレスまたはパスワードが間違っています');
        $this->setErrors('cancel', $e->getMessage());
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
      header('Location:' . SITE_URL . '/Duplazy/public_html/index.php');
      exit;
    }
  }

  private function _validate() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      track('tokenが不正です');
      echo "Invalid Token!";
      exit;
    }

    if (!isset($_POST['email']) || !isset($_POST['password'])) {
      echo "Invalid Form!";
      exit;
    }

    if ($_POST['email'] === '' || $_POST['password'] === '') {
      throw new \MyApp\Exception\EmptyPost();
    }
  }
}