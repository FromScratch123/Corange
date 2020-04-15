<?php

namespace MyApp\Controller;

class NotificationRead extends \MyApp\Controller {


  //loginの有無確認
  public function run() {
    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/public_html/index.php');
      exit;
    } 
      
    //messageをセット
    $this->setValues($_SESSION['messages']);
    //Userクラスをインスタンス化
    global $userModel;
    $userModel = new \MyApp\Model\User();
    //Workクラスをインスタンス化
    global $workModel;
    $workModel = new \MyApp\Model\Work();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      track('POST送信がありました');
      track('POST内容:' . print_r($_POST, true));
      $this->postProcess();
    }

  }


  protected function postProcess() {
    global $userModel;
    global $workModel;

    try {
      if (!empty($_POST['comment_id'])) {
        track('コメントを既読にします');
        $workModel->checkedCommentNote([
          'comment_id' => $_POST['comment_id']
        ]);
      } 
      
      if (!empty($_POST['favorite_id'])) {
        track('お気に入りを既読にします');
        $workModel->checkedFavoritetNote([
          'favorite_id' => $_POST['favorite_id']
        ]);
      } 
    
    } catch (\MyApp\Exception\Query $e) {
      track('クエリ実行に失敗しました');
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
      return;
    }

  }

}