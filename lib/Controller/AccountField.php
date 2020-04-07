<?php

namespace MyApp\Controller;

class AccountField extends \MyApp\Controller {


  //loginの有無確認
  public function run() {
    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/Duplazy/public_html/index.php');
      exit;
    } 
      
    //Userクラスをインスタンス化
    global $userModel;
    $userModel = new \MyApp\Model\User();
    //Chatクラスをインスタンス化
    global $chatModel;
    $chatModel = new \MyApp\Model\Chat();
    //friendクラスをインスタンス化
    global $friendModel;
    $friendModel = new \MyApp\Model\Friend();
    //Workクラスをインスタンス化
    global $workModel;
    $workModel = new \MyApp\Model\Work();
    
    //新規メッセージ数を取得
    $newMsgNum = $chatModel->getNewNum([
      'me' => $_SESSION['me']->id
    ]);
    //新規友達申請数を取得
    $newFriendNum = $friendModel->getNewNum([
      'me' => $_SESSION['me']->id
    ]);
    //新規コメント数を取得
    $newCommentNum = $workModel->getNewCommentNum([
      'me' => $_SESSION['me']->id
    ]);
    //新規お気に入り被登録数を取得
    $newFavoriteNum = $workModel->getNewFavoriteNum([
      'me' => $_SESSION['me']->id
    ]);

    $total = (int)$newMsgNum + (int)$newFriendNum + (int)$newCommentNum + (int)$newFavoriteNum;

    track('total: ' . print_r($total, true));
    //$totalを_notificationにセット
    $this->setProperties([
      'notification_total' => $total
    ], '_notifications');

  }


}