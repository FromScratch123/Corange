<?php

namespace MyApp\Controller;

class ChangePass extends \MyApp\Controller {

  //loginの有無確認
  public function run() {
    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/Duplazy/public_html/index.php');
      exit;
    }

    //Userクラスをインスタンス化
    global $userModel;
    $userModel = new \MyApp\Model\User();
    //Uploadクラスをインスタンス化
    global $uploadModel;
    $uploadModel = new \MyApp\Model\Upload();
    //インスタンスの_Propertiesにユーザーの属性をセット
    $userModel->setProperties($_SESSION['me']);
    //ユーザーの属性を取得
    $userProperties = $userModel->getProperties();
    //ユーザーの属性を値にセット
    $this->setValues($userProperties);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      track('POST送信がありました');
      $this->postProcess();
    }
  }

  protected function postProcess() {
    try {
      track('validate開始');
      $this->_validate();
    } catch (\MyApp\Exception\EmptyPost $e) {
      track('必須項目が未入力です');
      $this->setErrors('common', $e->getMessage());
    } catch (\MyApp\Exception\InvalidPassword $e) {
      track('パスワードが半角英数字ではありません');
      $this->setErrors('password', $e->getMessage());
    } 
    
    catch (\MyApp\Exception\UnmatchConfirmation $e) {
      track('パスワードの再入力が一致しません');
      $this->setErrors('password-confirmation', $e->getMessage());
    }

    //POSTされた値を保持(変更前の値ではなくPOSTの値を優先)
    $this->setValues($_POST);

    if ($this->hasError()) {
      return;
    } else {
      track('validateクリア');
      try {
        global $userModel;
        $user = $userModel->modify($_POST);
        track('流し込みデータ:'.print_r($_POST, true));
        if (!$user) {
          throw new \MyApp\Exception\Query();
        }
      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
        $this->setErrors('common', $e->getMessage());
        echo $e->getMessage();
        exit;
      }

      track('パスワード変更完了');
      $_SESSION['me'] = $user;
      $_SESSION['modify'] = true;
      track('HOMEへ遷移します');
      header('Location:' . SITE_URL . '/Duplazy/public_html/home.php');
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
      throw new \MyApp\Exception\EmptyPost();
    }
    //パスワードの英数字確認
     if (!preg_match('/\A[a-zA-z0-9]+\z/', $_POST['password'])) {
      error_log('英数文字ではありません');
      throw new \MyApp\Exception\InvalidPassword();
    }
     if (!preg_match('/\A[a-zA-z0-9]+\z/', $_POST['current-password'])) {
      error_log('英数文字ではありません');
      throw new \MyApp\Exception\InvalidPassword();
    }
     if (!preg_match('/\A[a-zA-z0-9]+\z/', $_POST['password-confirmation'])) {
      error_log('英数文字ではありません');
      throw new \MyApp\Exception\InvalidPassword();
    }
    //current-passwordの同値確認
    if (!password_verify($_POST['current-password'], $_SESSION['me']->password)) {
      track('現在のパスワードが一致しません');
      throw new \MyApp\Exception\UnmatchConfirmation();
    }
    //new-passwordの同値確認
    if ($_POST['password'] !== $_POST['password-confirmation']) {
      track('パスワードの再入力が一致しません');
      throw new \MyApp\Exception\UnmatchConfirmation();
    }
  }

  

}