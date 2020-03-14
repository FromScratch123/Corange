<?php

namespace MyApp\Controller;

class Login extends \MyApp\Controller {

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
      $this->_validate();
    } catch (\MyApp\Exception\EmptyPost $e) {
      $this->setErrors('login', $e->getMessage());
    } 

    $this->setValues($_POST);

    if ($this->hasError()) {
      track('入力エラーがありました');
      return;
    } else {
      track('バリデーションクリアしました');
      try {
        $userModel = new \MyApp\Model\User();
        $user = $userModel->login(['email' => $_POST['email'],
        'password' => $_POST['password']
        ]);
      } catch (\MyApp\Exception\UnmatchEmailOrPassword $e) {
        track('Exception:' . $e->getMessage());
        $this->setErrors('login', $e->getMessage());
        return;
      }

      session_regenerate_id(true);
      $_SESSION['me'] = $user;
      $_SESSION['modify'] = false;
      track('home.phpへ遷移します');
      header('Location:' . SITE_URL . '/Duplazy/public_html/home.php');
      exit;
    }
  }

  private function _validate() {
    //token認証
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "Invalid Token!";
      exit;
    }
    //email or password の入力確認
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
      echo "Invalid Form!";
      exit;
    }
    //email or password の入力確認
    if ($_POST['email'] === '' || $_POST['password'] === '') {
      throw new \MyApp\Exception\EmptyPost();
    }
  }
}