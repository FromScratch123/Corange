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
      track('validate開始');
      $this->_validate();
    } catch (\MyApp\Exception\EmptyPost $e) {
      track('必須項目が未入力です');
      $this->setErrors('empty', $e->getMessage());
    } catch (\MyApp\Exception\HalfAge $e) {
      track('半角数字ではありません');
      $this->setErrors('age', $e->getMessage());
    } catch (\MyApp\Exception\InvalidAge $e) {
      track('年齢が3桁を超えています');
      $this->setErrors('age', $e->getMessage());
    } catch (\MyApp\Exception\HalfTel $e) {
      track('半角数字ではありません');
      $this->setErrors('tel', $e->getMessage());
    } catch (\MyApp\Exception\InvalidTel $e) {
      track('電話番号の形式ではありません');
      $this->setErrors('tel', $e->getMessage());
    } catch (\MyApp\Exception\InvalidEmail $e) {
      track('Emailの形式ではありません');
      $this->setErrors('email', $e->getMessage());
    } catch (\MyApp\Exception\HalfZip $e) {
      track('半角数字ではありません');
      $this->setErrors('zip', $e->getMessage());
    } catch (\MyApp\Exception\InvalidZip $e) {
      track('郵便番号の形式ではありません');
      $this->setErrors('zip', $e->getMessage());
    } catch (\MyApp\Exception\HalfAddress $e) {
      track('半角数字ではありません');
      $this->setErrors('address', $e->getMessage());
    } catch (\MyApp\Exception\UnmatchConfirmation $e) {
      track('パスワードが一致しません');
      $this->setErrors('password', $e->getMessage());
    }

    //POSTされた値を保持(変更前の値ではなくPOSTの値を優先)
    $this->setValues($_POST);
    if ($this->hasError()) {
      return;
    } else {
      track('validateクリア');
      try {
        track('プロフィール変更開始');
          global $userModel;
          $user = $userModel->modify($_POST);
      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
        track($e->getMesssage());
        $this->setErrors('query', $e->getMessage());
        return;
      }

      track('プロフィール変更完了');
      $_SESSION['me'] = $user;
      $_SESSION['modify'] = true;
      track('変更後:' . print_r($_SESSION['me'], true));
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
    if ($_POST['surname'] === '' || $_POST['givenname'] === '' || $_POST['email'] === '') {
      throw new \MyApp\Exception\EmptyPost();
    }
    //ageの半角数字確認
    if(isset($_POST['age']) && $_POST['age'] !== "") {
      //1.半角数字確認
      if (!preg_match('/\A[0-9]+\z/', $_POST['age'])) {
        throw new \MyApp\Exception\HalfAge();
      } else if 
      //2.桁数確認
        ($_POST['age'] > 1000) {
        throw new \MyApp\Exception\InvalidAge();
      }
    }
    //電話番号形式確認
    if(isset($_POST['tel']) && $_POST['tel'] !== "") {
      //1.ハイフンを削除
      $tel = str_replace(array('-', 'ー', '−', '―', '‐'), '', $_POST['tel']);
      track('ハイフン削除後:'.$tel);
      //2.半角数字確認
      if (!preg_match('/\A[0-9]+\z/', $tel)) {
        throw new \MyApp\Exception\HalfTel();
      } else if 
      //3.形式確認
      (!preg_match("/^0\d{8,10}$/", $tel)) {
        throw new \MyApp\Exception\InvalidTel();
      }
    }
    //Emailの形式確認
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      throw new \MyApp\Exception\InvalidEmail();
    }
    //郵便番号の形式確認
    if(isset($_POST['zip']) && $_POST['zip'] !== "") {
      //1.ハイフンを削除
      $zip = str_replace(array('-', 'ー', '−', '―', '‐'), '', $_POST['zip']);
      track('ハイフン削除後:' . $zip);
      //2.半角数字確認
      if (!preg_match('/\A[0-9]+\z/', $zip)) {
        throw new \MyApp\Exception\HalfZip();
      } else if 
      //3.形式確認
       (!preg_match("/^\d{7}$/", $zip)) {
         throw new \MyApp\Exception\InvalidZip();
      }
    }
    //番地の形式確認
    if(isset($_POST['address']) && $_POST['address'] !== "") {
      //1.ハイフンを削除
      $address = str_replace(array('-', 'ー', '−', '―', '‐'), '', $_POST['address']);
      track('ハイフン削除後:' . $address);
      if (!preg_match('/\A[0-9]+\z/', $address)) {
        throw new \MyApp\Exception\HalfAddress();
      }
    }

    // //パスワードの半角英数字確認
    // if (!preg_match('/\A[a-zA-z0-9]+\z/', $_POST['password'])) {
    //   throw new \MyApp\Exception\HalfPassword();
    // }
    // //パスワードの同値確認
    // if ($_POST['password'] !== $_POST['password-confirmation']) {
    //   track('パスワードの入力に誤りがあります');
    //   throw new \MyApp\Exception\UnmatchConfirmation();
    // }
  }

}