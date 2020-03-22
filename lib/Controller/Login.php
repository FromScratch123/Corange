<?php

namespace MyApp\Controller;

class Login extends \MyApp\Controller {

  public function run() {
    if ($this->isLoggedIn()) {
      track('【ログイン済】home.phpへ遷移します');
      header('Location:' . SITE_URL . '/Duplazy/public_html/home.php');
      exit;
    }

    //messageをセット
    if (isset($_SESSION['messages'])) {
      $this->setValues($_SESSION['messages']);
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
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
    } catch (\MyApp\Exception\InvalidEmail $e) {
      track('Exception:' . $e->getMessage());
      $this->setErrors('email', $e->getMessage());
    } catch (\MyApp\Exception\HalfPassword $e) {
      track('Exception:' . $e->getMessage());
      $this->setErrors('password', $e->getMessage());
    } 

    $this->setValues($_POST);

    if ($this->hasError()) {
      track('入力エラー有');
      return;
    } else {
      track('バリデーションクリア');
      try {
        $userModel = new \MyApp\Model\User();
        $user = $userModel->login(['email' => $_POST['email'],
        'password' => $_POST['password']
        ]);
      } catch (\MyApp\Exception\UnmatchEmailOrPassword $e) {
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        return;
      }

      session_regenerate_id(true);
      $_SESSION['me'] = $user;
      $_SESSION['messages'] = [];
      $_SESSION['messages']['welcomeback'] = WELCOMEBACK;
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
    if (!isset($_POST['email']) || !isset($_POST['password']) || $_POST['email'] === '' || $_POST['password'] === '') {
      track('必須項目が未入力です');
      throw new \MyApp\Exception\EmptyPost();
    }
    //Emailの形式確認
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      track('Emailの形式ではありません');
      throw new \MyApp\Exception\InvalidEmail();
    }
    //パスワードの半角英数字確認
    if (!preg_match('/\A[a-zA-z0-9]+\z/', $_POST['password'])) {
      track('半角英数文字ではありません');
      throw new \MyApp\Exception\HalfPassword();
    }
  }
}