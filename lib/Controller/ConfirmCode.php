<?php

namespace MyApp\Controller;

class ConfirmCode extends \MyApp\Controller {

  public function run() {
    if ($this->isLoggedIn()) {
      track('【ログイン済】home.phpへ遷移します');
      header('Location:' . SITE_URL . '/public_html/home.php');
      exit;
    }

    if (!isset($_SESSION['auth_code']) || empty($_SESSION['auth_code'])) {
      track('【認証コード発行未】issueCode.phpへ遷移します');
      header('Location:' . SITE_URL . '/public_html/issueCode.php');
      exit;
    }

    //messageをセット
    $this->setValues($_SESSION['messages']);

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
    } catch(\MyApp\Exception\NoExistEmail $e) {
      track('Exception:' . $e->getMessage());
      $this->setErrors('email', $e->getMessage());
    } catch(\MyApp\Exception\UnmatchCode $e) {
      track('Exception:' . $e->getMessage());
      $this->setErrors('code', $e->getMessage());
    } catch(\MyApp\Exception\ExpireCode $e) {
      track('Exception:' . $e->getMessage());
      $this->setErrors('code', $e->getMessage());
    }

  
    //入力保持
    $this->setValues($_POST);

    if ($this->hasError()) {
      track('入力エラーがありました');
      return;
    } else {
      track('バリデーションクリアしました');
      try {
      $userModel = new \MyApp\Model\User();
      $user = $userModel->getAll('email', $_POST['email']);
      //ユーザー情報を格納
      $email = $user->email;
      $surname = $user->surname;
      $givenname = $user->givenname;
      //code生成
      $password = random(6);
      //メール送信
      $from = MAIL_ADDRESS;
      $to = $email;
      $subject = '【パスワード発行】 | Corange';
      $text = <<<EOM
      $surname $givenname 様
      
      こんにちは。
      いつもご利用いただき誠にありがとうございます。
      
      パスワード発行のご依頼を承りました。
      下記のパスワードを使ってログインしていただき、パスワードの再設定をお願いいたします。
      
      パスワード: $password
      ※必ずご自身で任意のパスワードへ変更してください。

      ログインページ: localhost:8888/Corange/public_html/login.php
      
      何かご不明点等ございましたら、お気軽にお問い合わせください。
      
      こちらのメールに心当たりがない場合は、お手数ですが破棄していただけますようお願い致します。
      
      ※自動送信メールですのでこちらのメールに返信は出来ません。
      
      *==============================*
      Corange Co.,Ltd.
      Tel: 00-0000-0000
      Email: Corange@gmail.com
      営業時間: 平日 10時00分~19時00分
      *==============================*
EOM;
      
    
     sendMail($from, $to, $subject, $text);
     track('メール送信内容:' . print_r(array([
        $from, $to, $subject, $text
      ]), true));

      $userModel->resetPass($password, $_SESSION['email']);

      } catch (\MyApp\Exception\FaildSendMail $e) {
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        return;
      }
      
      session_unset();
      $_SESSION['messages'] = [];
      $_SESSION['messages']['login'] = SENTPASS;
      

      track('login.phpへ遷移します');
      header('Location:' . SITE_URL . '/public_html/login.php');
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
      track('必須項目が未入力です');
      throw new \MyApp\Exception\EmptyPost();
    }
    //Emailの形式確認
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      track('Emailの形式ではありません');
      throw new \MyApp\Exception\InvalidEmail();
    }
    //$_POSTと$_SESSIONの比較
    if ($_POST['email'] !== $_SESSION['email']) {
      track('メールアドレスが一致しません');
      throw new \MyApp\Exception\NoExistEmail();
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