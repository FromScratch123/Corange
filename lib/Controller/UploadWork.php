<?php

namespace MyApp\Controller;

class UploadWork extends \MyApp\Controller {

  //loginの有無確認
  public function run() {

    //Workクラスをインスタンス化
    global $workModel;
    $workModel = new \MyApp\Model\Work();
    //Uploadクラスをインスタンス化
    global $uploadModel;
    $uploadModel = new \MyApp\Model\Upload();
    //カテゴリーを_categoriesにセット
    $categories = $workModel->getCategories();
    $this->setProperties($categories, '_categories');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      track('POST送信がありました');
      track('POST内容:' . print_r($_POST, true));
      track('ファイル内容(work-file):' . print_r($_FILES['work'], true));
      track('ファイル内容(thumbnail):' . print_r($_FILES['thumbnail'], true));
      $this->postProcess();
    }
  }

  protected function postProcess() {
    global $userModel;
    global $uploadModel;
    global $workModel;


    try {
      track('バリデーション開始');
      $this->_validate();
    } catch (\MyApp\Exception\EmptyPost $e) {
      track('必須項目が未入力です');
      track('Exception:' . $e->getMessage());
      $this->setErrors('empty', $e->getMessage());
    } catch (\MyApp\Exception\SizeOver $e) {
      track('ファイルサイズが規定値を超えています');
      track('Exception:' . $e->getMessage());
      $this->setErrors('work-file', $e->getMessage());
    } catch (\MyApp\Exception\NoSelected $e) {
      track('画像が選択されていません');
      track('Exception:' . $e->getMessage());
      $this->setErrors('work-file', $e->getMessage());
    } catch (\MyApp\Exception\UploadError $e) {
      track('画像のアップロードに失敗しました');
      track('Exception:' . $e->getMessage());
      $this->setErrors('work-file', $e->getMessage());
    } catch (\MyApp\Exception\IncompatibleType $e) {
      track('ファイルが画像形式ではありません');
      track('Exception:' . $e->getMessage());
      $this->setErrors('work-file', $e->getMessage());
    }

    //POSTされた値を保持(変更前の値ではなくPOSTの値を優先)
    $this->setValues($_POST);

    if ($this->hasError()) {
      return;
    } else {
      track('バリデーションクリア');
      try {
        track('workファイル保存処理開始');
        if (isset($_FILES['work']) && $_FILES['work']['error'] !== UPLOAD_ERR_NO_FILE && is_int($_FILES['work']['error'])) {
          //ファイル選択がある場合
          track('ファイルが選択されています');
          //ファイル形式の確認
          $workFileType = @pathinfo($_FILES['work']['name'], PATHINFO_EXTENSION);
          track('拡張子:' . $workFileType);
          if ($workFileType === 'gif' || $workFileType === 'jpg' || $workFileType === 'jpeg' || $workFileType === 'png' || $workFileType === 'GIF' || $workFileType === 'JPG' || $workFileType === 'PNG') {
            //画像ファイルの場合
            track('画像ファイルが選択されています');
            $isImage = true;
            //ファイルを保存先に移動し、保存先のパスを格納
            $workFilePath = $uploadModel->save($_FILES['work']);
            track('workファイル保存処理完了');
          } else {
            //動画ファイルの場合
            track('動画ファイルが選択されています');
            $isImage = false;
            //ファイルを保存先に移動し、保存先のパスを格納
            $workFilePath = $uploadModel->saveVideo($_FILES['work']);
            track('workファイル保存処理完了');
          }
        } 

        track('thumbnail画像保存処理開始');
        //ファイル選択状態を判定
        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] !== UPLOAD_ERR_NO_FILE) {
          //ファイル選択がある場合
          track('サムネイル画像が選択されています');
          //ファイルを保存先に移動し、保存先のパスを格納
          $thumbnailFilePath = $uploadModel->save($_FILES['thumbnail']);
          track('thumbnail画像保存処理終了');
        } else {
          //ファイルの選択がない場合
          track('サムネイル画像が選択されていません');
          if ($isImage) {
            $thumbnailFilePath = $workFilePath;
          } else {
            //デフォルト画像を格納
            $thumbnailFilePath = DEFAULT_WORK_THUMBNAIL;
            track('thumbnail画像保存処理終了');
          }
        }
      } catch (\MyApp\Exception\SaveFailure $e) {
        track('ファイルの移動に失敗しました');
        track('Exception:' . $e->getMessage());
        $this->setErrors('work-file', $e->getMessage());
        return;
      }
        track('ファイル保存処理終了');
      try {
        track('WORK新規登録処理開始');
        //アップロード内容をDBへ送る
        $work = $workModel->upload([
          'work' => $workFilePath,
          'thumbnail' => $thumbnailFilePath,
          'title' => $_POST['title'],
          'category' => $_POST['category'],
          'description' => $_POST['description'],
          'create_user' => $_SESSION['me']->id
        ]);
        track('登録内容:' . print_r($work, true));
    
      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        exit;
      }

      track('WORK新規登録処理完了');
     
      //メッセージの格納
      $_SESSION['messages'] = [];
      $_SESSION['messages']['home'] = UPLOADWORK;
      track('home.phpへ遷移します');
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
    if ($_POST['title'] === '' || $_POST['category'] === 0) {
      throw new \MyApp\Exception\EmptyPost();
    }
    if (empty($_FILES['work']) || !empty($_FILES['work']['name'])) {
      //エラー内容別に例外を投げる
      switch ($_FILES['work']['error']) {
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
      $workFileType = @pathinfo($_FILES['work']['name'],  PATHINFO_EXTENSION);
      switch ($workFileType) {
        case  'gif':
          return 'gif';
        case 'jpg':
          return 'jpg';
        case 'jpeg':
          return 'jpeg';
        case 'png':
          return 'png';
        case 'mp4':
          return 'mp4';
        case 'avi':
          return 'avi';
        case 'mov':
          return 'mov';
        case 'wmv':
          return 'wmv';
        default:
        throw new \MyApp\Exception\IncompatibleType();
      }
    }
    //thumbnailの確認
    if (!empty($_FILES['thumbnail']) && !empty($_FILES['thumbnail']['name'])) {
      //エラー内容別に例外を投げる
      switch ($_FILES['thumbnail']['error']) {
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
      $thumbnailFileType = @exif_imagetype($_FILES['thumbnail']['tmp_name']);
      switch ($thumbnailFileType) {
        case  'gif':
          return 'gif';
        case 'jpg':
          return 'jpg';
        case 'jpeg':
          return 'jpeg';
        case 'png':
          return 'png';
        default:
        throw new \MyApp\Exception\IncompatibleType();
      }
    }

    
  }  

}

