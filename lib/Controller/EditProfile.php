<?php

namespace MyApp\Controller;

class EditProfile extends \MyApp\Controller {

  //loginの有無確認
  public function run() {
    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/Duplazy/public_html/index.php');
      exit;
    }

    //Userクラスのインスタンス作成
    global $userModel;
    $userModel = new \MyApp\Model\User();
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
      //validate開始
      $this->_validate();
    } catch (\MyApp\Exception\EmptyPost $e) {
      $this->setErrors('empty', $e->getMessage());
    } catch (\MyApp\Exception\InvalidCharacters $e) {
      $this->setErrors('age', $e->getMessage());
    } catch (\MyApp\Exception\InvalidTel $e) {
      $this->setErrors('tel', $e->getMessage());
    } catch (\MyApp\Exception\InvalidEmail $e) {
      $this->setErrors('email', $e->getMessage());
    } catch (\MyApp\Exception\InvalidZip $e) {
      $this->setErrors('zip', $e->getMessage());
    } catch (\MyApp\Exception\InvalidCharacters $e) {
      $this->setErrors('password', $e->getMessage());
    } catch (\MyApp\Exception\UnmatchConfirmation $e) {
      $this->setErrors('password', $e->getMessage());
    }

    //POSTされた値を保持(変更前の値ではなくPOSTの値を優先)
    $this->setValues($_POST);
    if ($this->hasError()) {
      return;
    } else {
      try {
        track('プロフィール変更開始');
          global $userModel;
          $user = $userModel->modify($_POST);
      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
        $this->setErrors('query', $e->getMessage());
        return;
      }

      track('プロフィール変更完了');
      $_SESSION['me'] = $user;
      track('変更後:' . print_r($_SESSION['me'], true));
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
    //ageの半角数字確認
    if(!empty($_POST['age'])) {
      if (!preg_match('/\A[a-zA-z0-9]+\z/', $_POST['age'])) {
        error_log('年齢が半角英数文字ではありません');
        throw new \MyApp\Exception\InvalidCharacters();
      }

    }
    //電話番号形式確認
    //1.全角文字を半角に変換
    if(!empty($_POST['tel'])) {
      mb_convert_kana($_POST['tel'], 'n');
      //2.ハイフンを削除
      $tel = str_replace(array('-', 'ー', '−', '―', '‐'), '', $_POST['tel']);
      //3.形式確認
      if (!preg_match("/0\d{1,4}\d{1,4}\d{4}/", $tel)) {
        error_log('電話番号の形式に一致しません');
        throw new \MyApp\Exception\InvalidTel();
      }

    }
    //Emailの形式確認
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      error_log('Emailの形式に一致しません');
      throw new \MyApp\Exception\InvalidEmail();
    }
    //郵便番号の形式確認
    if(!empty($_POST['zip'])) {
      //1.全角文字を半角に変換
      mb_convert_kana($_POST['zip'], 'n');
      //2.ハイフンを削除
      $zip = str_replace(array('-', 'ー', '−', '―', '‐'), '', $_POST['zip']);
      //3.形式確認
      if(!preg_match("/^\d{7}$/", $zip)){
       error_log('郵便番号の形式に一致しません');
       throw new \MyApp\Exception\InvalidZip();
     }
    }
    //番地の形式確認
    if(!empty($_POST['address'])) {
      //1.全角文字を半角に変換
      mb_convert_kana($_POST['address'], 'n');
      //2.ハイフンを削除
      $address = str_replace(array('-', 'ー', '−', '―', '‐'), '', $_POST['address']);
      str_replace($address, '-', 3, 1);
    }

    //パスワードの半角英数字確認
    if (!preg_match('/\A[a-zA-z0-9]+\z/', $_POST['password'])) {
      error_log('半角英数文字ではありません');
      throw new \MyApp\Exception\InvalidCharacters();
    }
    // //パスワードの同値確認
    // if ($_POST['password'] !== $_POST['password-confirmation']) {
    //   error_log('パスワードの入力に誤りがあります');
    //   throw new \MyApp\Exception\UnmatchConfirmation();
    // }
  }

}