<?php

namespace MyApp\Controller;

class WorkDetails extends \MyApp\Controller {

  //loginの有無確認
  public function run() {

    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/public_html/index.php');
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
      //自身の作品か確認
      $res = $workModel->isMyWork([
        'work_id' => $_GET['w'],
        'me' => $_SESSION['me']->id
      ]);
      
      if ($res == 1) {
        track('自身の作品画面です');
        $this->setProperties([
          'myself' => true
        ], '_users');
        $this->getProcess();
      } else {
        track('他のユーザーの作品画面です');
        $this->getProcess();
      }
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
    //作品情報を_othersWorksと_valuesにセット
    $this->setProperties($work, '_work');
    $this->setValues($work);
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
      
      if (!empty($_POST['title']) || !empty($_POST['category']) || !empty($_POST['description']))  {

          //変更箇所確認
          if ($this->getProperties('_work')->title != $_POST['title'] || $this->getProperties('_work')->category != $_POST['category'] || $this->getProperties('_work')->description != $_POST['description']) {
         
            track('作品情報に変更箇所があります');
            try {
              track('作品情報更新処理開始');
              $workModel->modifiedWork([
              'title' => $_POST['title'],
              'category' => $_POST['category'],
              'description' => $_POST['description'],
              'work_id' => $this->getProperties('_work')->work_id
            ]);
          
          } catch (\MyApp\Exception\Query $e) {
            track('クエリ実行に失敗しました');
              track('Exception:' . $e->getMessage());
              $this->setErrors('common', $e->getMessage());
              return;
            }
          } else {
            track('作品情報に変更はありません');
            return;
          }
          track('作品情報更新処理終了');
          $_SESSION['messages'] = [];
          $_SESSION['messages']['work-details'] = MODIFIEDWORK;
          track('workDetails.phpへ遷移します');
          header('Location:' . SITE_URL . '/public_html/workDetails.php?w=' . $_GET['w']);
          exit;
      }

      if (!empty($_POST['comment'])) {
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
          $_SESSION['messages'] = [];
          $_SESSION['messages']['work-details'] = SENTCOMMENT;
          track('workDetails.phpへ遷移します');
          header('Location:' . SITE_URL . '/public_html/workDetails.php?w=' . $_GET['w']);
          exit;
        }
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
      if ($_POST['title'] === '') {
        throw new \MyApp\Exception\EmptyPost();
      }
      //必須項目確認
      if ($_POST['category'] === '') {
        throw new \MyApp\Exception\EmptyPost();
      }
   

    
  }  

}

