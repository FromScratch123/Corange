<?php

namespace MyApp\Controller;

class ChangePass extends \MyApp\Controller {

  //loginの有無確認
  public function run() {
    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/Corange/public_html/index.php');
      exit;
    }

    //messageを初期化
    $_SESSION['messages'] = [];
    //Userクラスをインスタンス化
    global $userModel;
    $userModel = new \MyApp\Model\User();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');
    //ユーザーの属性を取得

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
    } catch (\MyApp\Exception\HalfPassword $e) {
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
    } catch (\MyApp\Exception\UnmatchPassword $e) {
      track('Exception:' . $e->getMessage());
      $this->setErrors('current-password', $e->getMessage());
    } catch (\MyApp\Exception\UnmatchConfirmation $e) {
      track('Exception:' . $e->getMessage());
      $this->setErrors('password-confirmation', $e->getMessage());
    } catch (\MyApp\Exception\NoChanged $e) {
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
    }


    //POSTされた値を保持(変更前の値ではなくPOSTの値を優先)
    $this->setValues($_POST);

    if ($this->hasError()) {
      track('入力エラー有');
      return;
    } else {
      track('バリデーションクリア');
      try {
        track('パスワード変更処理開始');
        global $userModel;
        $userModel->modify([
          'password' => $_POST['password']
        ]);
        $user = $userModel->getAll('id', $_SESSION['me']->id);
      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        exit;
      }

      track('パスワード変更処理完了');
      $_SESSION['me'] = $user;
      $_SESSION['messages'] = [];
      $_SESSION['messages']['change-password'] = CHANGEPASS;
      track('HOMEへ遷移します');
      header('Location:' . SITE_URL . '/Corange/public_html/home.php');
      exit;
    }
  }

  private function _validate() {
    //tokenの確認
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      track('tokenが不正です');
      echo "Invalid Token!";
      exit;
    }
    //必須項目確認
    if ($_POST['current-password'] === '' || $_POST['password'] === '' || $_POST['password-confirmation'] === '') {
      track('必須項目が未入力です');
      throw new \MyApp\Exception\EmptyPost();
    }
    //パスワードの半角英数字確認
    if (!preg_match('/\A[a-zA-z0-9]+\z/', $_POST['current-password'])) {
      track('半角英数文字ではありません');
      throw new \MyApp\Exception\HalfPassword();
    }
    if (!preg_match('/\A[a-zA-z0-9]+\z/', $_POST['password'])) {
      track('半角英数文字ではありません');
      throw new \MyApp\Exception\HalfPassword();
    }
    if (!preg_match('/\A[a-zA-z0-9]+\z/', $_POST['password-confirmation'])) {
      track('半角英数文字ではありません');
      throw new \MyApp\Exception\HalfPassword();
    }
    //current-passwordの同値確認
    if (!password_verify($_POST['current-password'], $_SESSION['me']->password)) {
      track('現在のパスワードが一致しません');
      throw new \MyApp\Exception\UnmatchPassword();
    }
    //new-passwordの同値確認
    if ($_POST['password'] !== $_POST['password-confirmation']) {
      track('パスワードの再入力が一致しません');
      throw new \MyApp\Exception\UnmatchConfirmation();
    }
    //current-passwordとnew-passwordを比較
    if (password_verify($_POST['password'], $_SESSION['me']->password)) {
      track('変更前と同一のパスワードです');
      throw new \MyApp\Exception\NoChanged();
    }
  }

  

}