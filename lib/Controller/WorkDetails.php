<?php

namespace MyApp\Controller;

class WorkDetails extends \MyApp\Controller {

  //loginの有無確認
  public function run() {

    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/Corange/public_html/index.php');
      exit;
    } 

    global $userModel;
    $userModel = new \MyApp\Model\User();
    //Workクラスをインスタンス化
    global $workModel;
    $workModel = new \MyApp\Model\Work();
    //Uploadクラスをインスタンス化
    global $uploadModel;
    $uploadModel = new \MyApp\Model\Upload();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');
    //カテゴリーを_categoriesにセット
    $categories = $workModel->getCategories();
    $this->setProperties($categories, '_categories');

    if(!empty($_GET)) {
      track('GET送信がありました');
      track('GET内容:' . print_r($_GET, true));
      $this->getProcess();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      track('POST送信がありました');
      track('POST内容:' . print_r($_POST, true));
      $this->postProcess();
    }
  }

  protected function getProcess() {
    global $userModel;
    global $uploadModel;
    global $workModel;

    $work = $workModel->getWork([
      'work_id' => $_GET['w']
    ]);
    //お気に入り状況追加
      $isFavorite = $workModel->isFavorite([
        'me' => $_SESSION['me']->id,
        'work_id' => $work->work_id
      ]);
       $work->isFavorite = $isFavorite;

    //お気に入りの数を追加
      $favoriteNum = $workModel->favoriteNum([
        'work_id' => $work->work_id
      ]);
      $work->favoriteNum = $favoriteNum;
  
    track('work情報: ' . print_r($work, true));
    //作品情報を_othersWorksにセット
    $this->setProperties($work, '_work');
    $comment = $workModel->getComment([
      'work_id' => $_GET['w']
    ]);
    if (!$comment) {
      return;
    } else {
      track('comment情報: ' . print_r($comment, true));
      //コメント情報を_commentにセット
    $this->setProperties($comment, '_comment');
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
    } 
    //POSTされた値を保持(変更前の値ではなくPOSTの値を優先)
    $this->setValues($_POST);

    if ($this->hasError()) {
      return;
    } else {
      track('バリデーションクリア');
      track('コメント保存処理開始');
      try {
        $workModel->insertComment([
          'work_id' => $_GET['w'],
          'comment' => $_POST['comment'],
          'post_user' => $_SESSION['me']->id
        ]);
      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
          track('Exception:' . $e->getMessage());
          $this->setErrors('common', $e->getMessage());
          return;
        }
        track('workDetails.phpへ遷移します');
        header('Location:' . SITE_URL . '/Corange/public_html/workDetails.php?w=' . $_GET['w']);
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
    if ($_POST['comment'] === '') {
      throw new \MyApp\Exception\EmptyPost();
    }
   

    
  }  

}

