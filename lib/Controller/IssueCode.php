<?php

namespace MyApp\Controller;

class IssueCode extends \MyApp\Controller {

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
      $this->setErrors('email-confirmation', $e->getMessage());
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
        $user = $userModel->getAll($_POST['email']);
        if (!$user) {
          throw new \MyApp\Exception\NoExistEmail();
        }
      } catch (\MyApp\Exception\NoExistEmail $e) {
        track('登録されていないメールアドレスです');
        $this->setErrors('email', $e->getMessage());
        exit;
      }

      try {
      $email = $user->email;
      $surname = $user->surname;
      $givenname = $user->givenname;
      //code生成
      $code = $userModel->issueCode();
      //メール送信
      $from = MAIL_ADDRESS;
      $to = $email;
      $subject = '【認証コード発行】 | Duplazy';
      $text = <<<EOM
      $surname $givenname 様
      
      こんにちは。
      いつもご利用いただき誠にありがとうございます。
      
      認証コード発行のご依頼を承りました。
      下記の認証コードを使ってパスワードの再発行をお願いいたします。
      
      認証コード: $code
      ※認証コード有効期限は発行日時より30分間です。

      認証コード入力ページ: 
      localhost:8888/Duplazy/public_html/confirmCode.php
      
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

        track('メール送信内容' . print_r(array([
          $from, $to, $subject, $text
        ]), true));
        if (!$is_success) {
          throw new \MyApp\Exception\FaildIssueCode();
        }
      } catch (\MyApp\Exception\FaildIssueCode $e) {
        track('認証コードの発行に失敗しました');
        $this->setErrors('common', $e->getMessage());
        return;
      }

      $_SESSION['auth_code'] = $code;
      $_SESSION['code_limit'] = time() + (60 * 30);
      $_SESSION['email'] = $email;
      track(print_r($_SESSION, true));
      track('メール送信完了しました');
      track('confirmCode.phpへ遷移します');
      header('Location:' . SITE_URL . '/Duplazy/public_html/confirmCode.php');
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
     if ($_POST['email'] === '' || $_POST['email-confirmation'] === '') {
      throw new \MyApp\Exception\EmptyPost();
    }
    //Emailの形式確認
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      throw new \MyApp\Exception\InvalidEmail();
    }

    //Emailの同値確認
    if ($_POST['email'] !== $_POST['email-confirmation']) {
      track('メールアドレスの再入力が一致しません');
      throw new \MyApp\Exception\UnmatchConfirmation();
    }
  }
}