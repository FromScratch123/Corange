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
      track('バリデーション開始');
      $this->_validate();
    } catch (\MyApp\Exception\EmptyPost $e) {
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
    } catch (\MyApp\Exception\InvalidEmail $e) {
      track('Exception:' . $e->getMessage());
      $this->setErrors('email', $e->getMessage());
    } catch(\MyApp\Exception\UnmatchConfirmation $e) {
      track('Exception:' . $e->getMessage());
      $this->setErrors('email-confirmation', $e->getMessage());
    }

  
    //POSTされた値を保持(変更前の値ではなくPOSTの値を優先)
    $this->setValues($_POST);

    if ($this->hasError()) {
      track('入力エラー有');
      return;
    } else {
      track('バリデーションクリア');
      try {
      $userModel = new \MyApp\Model\User();
      $user = $userModel->getAll('email', $_POST['email']);
      } catch (\MyApp\Exception\Query $e) {
        track('登録されていないメールアドレスです');
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        return;
      }

      try {
      //ユーザー情報を格納
      $email = $user->email;
      $surname = $user->surname;
      $givenname = $user->givenname;
      //code生成
      $code = random(4);
      //メールの内容を格納
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
      
    
        sendMail($from, $to, $subject, $text);
        track('メール送信内容' . print_r(array([
          $from, $to, $subject, $text
        ]), true));

      } catch (\MyApp\Exception\FaildSendMail $e) {
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        return;
      }
      track('メール送信完了しました');

      $_SESSION['auth_code'] = $code;
      $_SESSION['code_limit'] = time() + (60 * 30);
      $_SESSION['email'] = $email;
      $_SESSION['messages'] = [];
      $_SESSION['messages']['welcome'] = SENDCODE;
      track('セッションの中身:' . print_r($_SESSION, true));
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
      track('必須項目が未入力です');
      throw new \MyApp\Exception\EmptyPost();
    }
    //Emailの形式確認
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      track('Emailの形式ではありません');
      throw new \MyApp\Exception\InvalidEmail();
    }
    //Emailの同値確認
    if ($_POST['email'] !== $_POST['email-confirmation']) {
      track('メールアドレスの再入力が一致しません');
      throw new \MyApp\Exception\UnmatchConfirmation();
    }
  }
}