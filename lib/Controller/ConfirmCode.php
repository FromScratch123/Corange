<?php

namespace MyApp\Controller;

class ConfirmCode extends \MyApp\Controller {

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
      track('validate開始');
      $this->_validate();
    } catch (\MyApp\Exception\EmptyPost $e) {
      $this->setErrors('common', $e->getMessage());
    } catch (\MyApp\Exception\InvalidEmail $e) {
      $this->setErrors('email', $e->getMessage());
    } catch(\MyApp\Exception\UnmatchConfirmation $e) {
      $this->setErrors('code', $e->getMessage());
    } catch(\MyApp\Exception\UnmatchCode $e) {
      $this->setErrors('code', $e->getMessage());
    } catch(\MyApp\Exception\ExpireCode $e) {
      $this->setErrors('code', $e->getMessage());
    }

  
    //入力保持
    $this->setValues($_POST);

    if ($this->hasError()) {
      track('入力エラーがありました');
      return;
    } else {
      try {
      track('バリデーションクリアしました');
      $userModel = new \MyApp\Model\User();
      $user = $userModel->getAll($_SESSION['email']);
        if (!$user) {
          throw new \MyApp\Exception\FaildIssuePass();
        }
      $email = $user->email;
      $surname = $user->surname;
      $givenname = $user->givenname;
      //code生成
      $password = $userModel->issueCode();
      //メール送信
      $from = MAIL_ADDRESS;
      $to = $email;
      $subject = '【パスワード発行】 | Duplazy';
      $text = <<<EOM
      $surname $givenname 様
      
      こんにちは。
      いつもご利用いただき誠にありがとうございます。
      
      パスワード再発行のご依頼を承りました。
      下記のパスワードを使ってログインしていただき、パスワードの再設定をお願いいたします。
      
      パスワード: $password
      ※必ずご自身で任意のパスワードへ変更してください。

      ログインページ: localhost:8888/Duplazy/public_html/login.php
      
      何かご不明点等ございましたら、お気軽にお問い合わせください。
      
      こちらのメールに心当たりがない場合は、お手数ですが破棄していただけますようお願い致します。
      
      ※自動送信メールですのでこちらのメールに返信は出来ません。
      
      *==============================*
      Duplazy Co.,Ltd.
      Tel: 00-0000-0000
      Email: duplazy@gmail.com
      営業時間: 平日 10時00分~19時00分
      *==============================*
      EOM;
      
    
      $is_success = sendMail($from, $to, $subject, $text);

      track('メール送信内容:' . print_r(array([
        $from, $to, $subject, $text
      ]), true));
        if (!$is_success) {
          throw new \MyApp\Exception\FaildIssuePass();
        } 

      $userModel->resetPass($password, $_SESSION['email']);

      } catch (\MyApp\Exception\FaildIssuePass $e) {
        track('パスワードの再発行に失敗しました');
        $this->setErrors('common', $e->getMessage());
        return;
      }
      
      session_unset();

      track('login.phpへ遷移します');
      header('Location:' . SITE_URL . '/Duplazy/public_html/login.php');
      exit;
    
    }
  }
  
    private function _validate() {
    // token認証
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "Invalid Token!";
      exit;
    }
     //必須項目確認
     if ($_POST['email'] === '' || $_POST['code'] === '') {
      throw new \MyApp\Exception\EmptyPost();
    }
    //Emailの形式確認
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      throw new \MyApp\Exception\InvalidEmail();
    }
    //Emailの同値確認
    if ($_POST['email'] !== $_SESSION['email']) {
      track('メールアドレスが正しくありません');
      throw new \MyApp\Exception\UnmatchConfirmation();
    }
       //auth-codeの有効期限確認
       if (time() > $_SESSION['code_limit']) {
        track('認証コードの有効期限が切れています');
        throw new \MyApp\Exception\ExpireCode();
      }
    //auth-codeの同値確認
    if ($_POST['code'] !== $_SESSION['auth_code']) {
      track('認証コードが間違っています');
      throw new \MyApp\Exception\UnmatchCode();
    }
 
  }
}