<?php

namespace MyApp\Controller;

class ChatList extends \MyApp\Controller {

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
    //Chatクラスをインスタンス化
    global $chatModel;
    $chatModel = new \MyApp\Model\Chat();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');

    try {
    //掲示板情報を取得
      track('掲示板情報取得');
      $rooms = $chatModel->getrooms($_SESSION['me']->id, 'modified_date', 'DESC');
      track('掲示板情報:' . print_r($rooms, true));
    //_roomsに掲示板情報をセット
      $this->setProperties($rooms, '_rooms');

    //相手の情報を取得
      track('相手情報取得');
      $clients = [];
      for ($i = 0; isset($this->getProperties('_rooms')->$i); $i++) {
        //clientのIDを判別
        if ($this->getProperties('_rooms')->$i->host_user === $_SESSION['me']->id) {
          $client_id = $this->getProperties('_rooms')->$i->invited_user;
        } else {
          $client_id = $this->getProperties('_rooms')->$i->host_user;
        }
        array_push($clients, $userModel->getAll('id', $client_id));
       
        //_clientsに相手情報をセット
        $this->setProperties($clients, '_clients');
      }
        track('相手情報: ' . print_r($clients, true));
      
    //メッセージ情報を取得
      track('メッセージ情報取得');
      $messages = [];
      for ($i = 0; isset($this->getProperties('_rooms')->$i); $i++) {
        $room_id = $this->getProperties('_rooms')->$i->id;
        track('room_id: ' . $room_id);
        array_push($messages, $chatModel->getMsgs($room_id, 'modified_date', 'DESC'));
      }
      track('メッセージ情報:' . print_r($messages, true));
    //_messagesにメッセージ情報をセット
      $this->setProperties($messages, '_messages');

    

    } catch (\MyApp\Exception\Query $e) {
      track('クエリ実行に失敗しました');
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        return;
    }

  }

}