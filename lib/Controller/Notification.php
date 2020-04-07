<?php

namespace MyApp\Controller;

class Notification extends \MyApp\Controller {

  //loginの有無確認
  public function run() {
    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/Corange/public_html/index.php');
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
    //Chatクラスをインスタンス化
    global $chatModel;
    $chatModel = new \MyApp\Model\Chat();
    //Workクラスをインスタンス化
    global $workModel;
    $workModel = new \MyApp\Model\Work();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');

    //新規友達申請を取得
      track('新規友達申請取得');
      $friends = $friendModel->getNew([
        'followed_user' => $_SESSION['me']->id
      ]);
      if (!$friends) {
        track('新規友達申請はありません');
      } else {
        track('新規友達申請があります');
        track('新規友達申請者情報:' . print_r($friends, true));
      //_friendsに新規友達申請者情報をセット
        $this->setProperties($friends, '_friends');
      }

    //新規メッセージを取得
      track('新規メッセージ取得');
      $messages = $chatModel->getNew([
        'to_user' => $_SESSION['me']->id
      ]);
      if (!$messages) {
        track('新規メッセージはありません');
      } else {
        track('新規メッセージがあります');
        track('新規メッセージ情報:' . print_r($messages, true));
      //_messagesに新規メッセージ情報をセット
        $this->setProperties($messages, '_messages');
      }

    //新規コメントを取得
      track('新規コメント取得');
      $comments = $workModel->getNewComment([
        'me' => $_SESSION['me']->id
      ]);
      if (!$comments) {
        track('新規コメントはありません');
      } else {
        track('新規コメントがあります');
        track('新規コメント情報:' . print_r($comments, true));
        //_commentsに新規コメント情報をセット
        $this->setProperties($comments, '_comments');
      }
    
    //新規お気に入りを取得
      track('新規お気に入り登録を取得');
      $favorites = $workModel->getNewFavorite([
        'me' => $_SESSION['me']->id
        ]);
        if (!$favorites) {
          track('新規お気に入り登録はありません');
        } else {
          track('新規お気に入り登録があります');
          track('新規お気に入り登録情報:' . print_r($favorites, true));
          //_favoritesに新規コメント情報をセット
          $this->setProperties($favorites, '_favorites');
  }


  }

}