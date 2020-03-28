<?php

namespace MyApp\Controller;

class Profile extends \MyApp\Controller {

  //loginの有無確認
  public function run() {
    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/Duplazy/public_html/index.php');
      exit;
    } 
      
    //messageをセット
    $this->setValues($_SESSION['messages']);
    //Userクラスをインスタンス化
    global $userModel;
    $userModel = new \MyApp\Model\User();
    //friendクラスをインスタンス化
    global $friendModel;
    $friendModel = new \MyApp\Model\Friend();
    global $uploadModel;
    $uploadModel = new \MyApp\Model\Upload();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');
    //ユーザーの属性をValuesにセット
    $this->setValues($_SESSION['me']);

    if (isset($_GET['u'])) {
      track('GET送信がありました');
      track('GET内容:' . print_r($_GET, true));

      if ($_GET['u'] === $_SESSION['me']->id) {
        track('自身のプロフィール画面です');
        $this->setProperties([
          'myself' => true
        ], '_users');
      } else {
        track('他のユーザーのプロフィール画面です');
        $this->getProcess();
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      track('POST送信がありました');
      track('POST内容:' . print_r($_POST, true));
      track('ファイル内容:' . print_r($_FILES, true));
      $this->postProcess();
    }

  }

  private function getProcess() {
    global $userModel;
    global $friendModel;
    try {
      $user = $userModel->getProfile([
        'id' => $_GET['u']
      ]);

    } catch (\MyApp\Exception\Query $e) {
      track('クエリ実行に失敗しました');
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
      exit;
    }

    //取得したprofile情報を_friendにセット
    $this->setProperties($user, '_friends');
    track('ユーザー情報:' . print_r($user, true));
  }


  private function postProcess() {
    global $userModel;
    global $uploadModel;
    
    try {
      track('バリデーション開始');
      $this->_validate();
    } catch (\MyApp\Exception\OverLength $e) {
      track('文字数制限を超えています');
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
    } catch (\MyApp\Exception\SizeOver $e) {
      track('ファイルサイズが規定値を超えています');
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
    } catch (\MyApp\Exception\NoSelected $e) {
      track('画像が選択されていません');
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
    } catch (\MyApp\Exception\UploadError $e) {
      track('画像のアップロードに失敗しました');
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
    } catch (\MyApp\Exception\IncompatibleType $e) {
      track('ファイルが画像形式ではありません');
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
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
        if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] !== UPLOAD_ERR_NO_FILE) {
          //ファイル選択がある場合
          track('アイコン画像が選択されています');
          //ファイルを保存先に移動し、保存先のパスを格納
          $iconFilePath = $uploadModel->save($_FILES['profile_img']);
          
        } else if (isset($_SESSION['me']->profile_img)){
          //ファイルは選択されていないが、DBに保存がされている場合
          track('アイコン画像の変更はありません');
          //DBの保存先を格納
          $iconFilePath = $_SESSION['me']->profile_img;
        } else {
          //ファイルの選択がなく、DBにも保存されていない場合
          track('アイコン画像の登録がありません');
          //デフォルト画像を格納
          $iconFilePath = DEFAULT_USER_ICON;
        }
        track('バナー画像保存処理開始');
        //ファイル選択状態を判定
        if (isset($_FILES['banner_img']) && $_FILES['banner_img']['error'] !== UPLOAD_ERR_NO_FILE) {
          //ファイル選択がある場合
          track('バナー画像が選択されています');
          //ファイルを保存先に移動し、保存先のパスを格納
          $bannerFilePath = $uploadModel->save($_FILES['banner_img']);
        } else if (isset($_SESSION['me']->banner_img)){
          //ファイルは選択されていないが、DBに保存がされている場合
          track('バナー画像の変更はありません');
          //DBの保存先を格納
          $bannerFilePath = $_SESSION['me']->banner_img;
        } else {
          //ファイルの選択がなく、DBにも保存されていない場合
          track('アイコン画像の登録がありません');
          //デフォルト画像を格納
          $bannerFilePath = DEFAULT_USER_BANNER;
        }
      } catch (\MyApp\Exception\SaveFailure $e) {
        track('ファイルの移動に失敗しました');
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        return;
      }
        track('画像保存処理終了');
    try {
        track('プロフィール変更処理開始');

    //元のデータとPOSTのデータを比較
    $before = [
      'banner_img' => $_SESSION['me']->banner_img,
      'slogan' => $_SESSION['me']->slogan,
      'profile' => $_SESSION['me']->profile,
      'profile_img' => $_SESSION['me']->profile_img
    ];
    $after = [
      'banner_img' => $bannerFilePath,
      'slogan' => $_POST['slogan'],
      'profile' => $_POST['profile'],
      'profile_img' => $iconFilePath
    ];

    if ($before == $after) {
      track('変更箇所がありません');
      $_SESSION['messages'] = [];
      track('HOMEへ遷移します');
      header('Location:' . SITE_URL . '/Duplazy/public_html/home.php');
      exit;
    }

      track('変更箇所があります');
      //変更項目をDBへ送る
      $userModel->modify([
        'banner_img' => $bannerFilePath,
        'slogan' => $_POST['slogan'],
        'profile' => $_POST['profile'],
        'profile_img' => $iconFilePath
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
    $_SESSION['messages']['modifiedProfile'] = MODIFIEDPROFILE;
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
    //sloganの字数制限の確認
    if (mb_strlen($_POST['slogan'], 'UTF-8') > 50) {
      throw new \MyApp\Exception\OverLength();
    }
    //profileの字数制限の確認
    if (mb_strlen($_POST['profile'], 'UTF-8') > 250) {
      throw new \MyApp\Exception\OverLength();
    }
    //profile_imgの確認
    if (!empty($_FILES['profile_img']) &&  !empty($_FILES['profile_img']['name'])) {
      //エラー内容別に例外を投げる
      switch ($_FILES['profile_img']['error']) {
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
      $iconImageType = @exif_imagetype($_FILES['profile_img']['tmp_name']);
      switch ($iconImageType) {
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
    //banner_imgの確認
    if (!empty($_FILES['banner_img']) &&  !empty($_FILES['banner_img']['name'])) {
      //エラー内容別に例外を投げる
      switch ($_FILES['banner_img']['error']) {
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
      $bannerImageType = @exif_imagetype($_FILES['banner_img']['tmp_name']);
      switch ($bannerImageType) {
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