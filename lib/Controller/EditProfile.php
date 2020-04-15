<?php

namespace MyApp\Controller;

class EditProfile extends \MyApp\Controller {

  //loginの有無確認
  public function run() {
    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/public_html/index.php');
      exit;
    }

    //Userクラスをインスタンス化
    global $userModel;
    $userModel = new \MyApp\Model\User();
    //Uploadクラスをインスタンス化
    global $uploadModel;
    $uploadModel = new \MyApp\Model\Upload();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');
    //ユーザーの属性をValuesにセット
    $this->setValues($_SESSION['me']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      track('POST送信がありました');
      track('POST内容:' . print_r($_POST, true));
      track('ファイル内容:' . print_r($_FILES['user-icon'], true));
      $this->postProcess();
    }
  }

  protected function postProcess() {
    global $userModel;
    global $uploadModel;
 

    try {
      track('バリデーション開始');
      $this->_validate();
    } catch (\MyApp\Exception\EmptyPost $e) {
      track('必須項目が未入力です');
      track('Exception:' . $e->getMessage());
      $this->setErrors('empty', $e->getMessage());
    } catch (\MyApp\Exception\HalfAge $e) {
      track('半角数字ではありません');
      track('Exception:' . $e->getMessage());
      $this->setErrors('age', $e->getMessage());
    } catch (\MyApp\Exception\InvalidAge $e) {
      track('年齢が3桁を超えています');
      track('Exception:' . $e->getMessage());
      $this->setErrors('age', $e->getMessage());
    } catch (\MyApp\Exception\HalfTel $e) {
      track('半角数字ではありません');
      track('Exception:' . $e->getMessage());
      $this->setErrors('tel', $e->getMessage());
    } catch (\MyApp\Exception\InvalidTel $e) {
      track('電話番号の形式ではありません');
      track('Exception:' . $e->getMessage());
      $this->setErrors('tel', $e->getMessage());
    } catch (\MyApp\Exception\InvalidEmail $e) {
      track('Emailの形式ではありません');
      track('Exception:' . $e->getMessage());
      $this->setErrors('email', $e->getMessage());
    } catch (\MyApp\Exception\HalfZip $e) {
      track('半角数字ではありません');
      track('Exception:' . $e->getMessage());
      $this->setErrors('zip', $e->getMessage());
    } catch (\MyApp\Exception\InvalidZip $e) {
      track('郵便番号の形式ではありません');
      track('Exception:' . $e->getMessage());
      $this->setErrors('zip', $e->getMessage());
    } catch (\MyApp\Exception\HalfAddress $e) {
      track('半角数字ではありません');
      track('Exception:' . $e->getMessage());
      $this->setErrors('address', $e->getMessage());
    } catch (\MyApp\Exception\SizeOver $e) {
      track('ファイルサイズが規定値を超えています');
      track('Exception:' . $e->getMessage());
      $this->setErrors('user-icon', $e->getMessage());
    } catch (\MyApp\Exception\NoSelected $e) {
      track('画像が選択されていません');
      track('Exception:' . $e->getMessage());
      $this->setErrors('user-icon', $e->getMessage());
    } catch (\MyApp\Exception\UploadError $e) {
      track('画像のアップロードに失敗しました');
      track('Exception:' . $e->getMessage());
      $this->setErrors('user-icon', $e->getMessage());
    } catch (\MyApp\Exception\IncompatibleType $e) {
      track('ファイルが画像形式ではありません');
      track('Exception:' . $e->getMessage());
      $this->setErrors('user-icon', $e->getMessage());
    }

    //POSTされた値を保持(変更前の値ではなくPOSTの値を優先)
    $this->setValues($_POST);

    if ($this->hasError()) {
      return;
    } else {
      track('バリデーションクリア');
      try {
        track('アイコン画像保存処理開始');
        //ファイル選択状態を判定
        if (isset($_FILES['user-icon']) && $_FILES['user-icon']['error'] !== UPLOAD_ERR_NO_FILE) {
          //ファイル選択がある場合
          track('アイコン画像が選択されています');
          //ファイルを保存先に移動し、保存先のパスを格納
          $filePath = $uploadModel->save($_FILES['user-icon']);
        } else if (isset($_SESSION['me']->profile_img)){
          //ファイルは選択されていないが、DBに保存がされている場合
          track('アイコン画像の変更はありません');
          //DBの保存先を格納
          $filePath = $_SESSION['me']->profile_img;
        } else {
          //ファイルの選択がなく、DBにも保存されていない場合
          track('アイコン画像の登録がありません');
          //デフォルト画像を格納
          $filePath = DEFAULT_USER_ICON;
        }
      } catch (\MyApp\Exception\SaveFailure $e) {
        track('ファイルの移動に失敗しました');
        track('Exception:' . $e->getMessage());
        $this->setErrors('user-icon', $e->getMessage());
        return;
      }
        track('アイコン画像保存処理終了');
      try {
        track('プロフィール変更処理開始');

        //元のデータとPOSTのデータを比較
        $before = [
          'surname' => $_SESSION['me']->surname,
          'givenname' => $_SESSION['me']->givenname,
          'age' => $_SESSION['me']->age,
          'tel' => $_SESSION['me']->tel,
          'email' => $_SESSION['me']->email,
          'zip' => $_SESSION['me']->zip,
          'prefecture' => $_SESSION['me']->prefecture,
          'municipalities' => $_SESSION['me']->municipalities,
          'profile_img' => $_SESSION['me']->profile_img
        ];
        $after = [
          'surname' => $_POST['surname'],
          'givenname' => $_POST['givenname'],
          'age' => $_POST['age'],
          'tel' => $_POST['tel'],
          'email' => $_POST['email'],
          'zip' => $_POST['zip'],
          'prefecture' => $_POST['prefecture'],
          'municipalities' => $_POST['municipalities'],
          'profile_img' => $filePath
        ];

        if ($before == $after) {
          track('変更箇所がありません');
          $_SESSION['messages'] = [];
          track('HOMEへ遷移します');
          header('Location:' . SITE_URL . '/public_html/home.php');
          exit;
        }

        track('変更箇所があります');
        //変更項目をDBへ送る
        $userModel->modify([
          'surname' => $_POST['surname'],
          'givenname' => $_POST['givenname'],
          'age' => $_POST['age'],
          'tel' => $_POST['tel'],
          'email' => $_POST['email'],
          'zip' => $_POST['zip'],
          'prefecture' => $_POST['prefecture'],
          'municipalities' => $_POST['municipalities'],
          'profile_img' => $filePath
        ]);
        //変更後のユーザー情報を取得
        $user = $userModel->getAll('id', $_SESSION['me']->id);
      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        exit;
      }

      track('プロフィール変更処理完了');
      //変更後のユーザー情報をセッションへ格納
      $_SESSION['me'] = $user;
      track('変更後:' . print_r($_SESSION['me'], true));
      //メッセージの格納
      $_SESSION['messages'] = [];
      $_SESSION['messages']['home'] = MODIFIEDPROFILE;
      track('HOMEへ遷移します');
      header('Location:' . SITE_URL . '/public_html/home.php');
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
    //user-iconの確認
    if (!empty($_FILES['user-icon']) &&  !empty($_FILES['user-icon']['name'])) {
      //エラー内容別に例外を投げる
      switch ($_FILES['user-icon']['error']) {
        case UPLOAD_ERR_OK:
          return true;
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
          throw new \MyApp\Exception\SizeOver();
        case UPLOAD_ERR_NO_FILE:
          throw new \MyApp\Exception\NoSelected();
        default:
          throw new \MyApp\Exception\UploadError();
      }
      //MIMEタイプの確認
      $imageType = @exif_imagetype($_FILES['user-icon']['tmp_name']);
      switch ($imageType) {
        case IMAGETYPE_GIF:
          return 'gif';
        case IMAGETYPE_JPEG:
          return 'jpg';
        case IMAGETYPE_PNG:
          return 'png';
        default:
        throw new \MyApp\Exception\IncompatibleType();
      }

      }
    }

    
  }

  

}