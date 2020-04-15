<?php

namespace MyApp\Controller;

class Chat extends \MyApp\Controller {


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
    //Chatクラスをインスタンス化
    global $chatModel;
    $chatModel = new \MyApp\Model\Chat();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');


    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
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
    global $chatModel;

    $isBelonged = $chatModel->isBelonged([
      'id' => $_GET['r'],
      'me' => $_SESSION['me']->id
    ]);

    if ($isBelonged == false) {
      track('GETパラメーターが不正です');
      track('home.phpへ遷移します');
      header('Location:' . SITE_URL . '/public_html/home.php');
      exit;
    }

    try {
    //掲示板情報を取得
    track('掲示板情報取得');
    $room = $chatModel->getRoom([
      'id' => $_GET['r']]);
    track('掲示板情報:' . print_r($room, true));
  //_roomsに掲示板情報をセット
    $this->setProperties($room, '_rooms');
    //clientのIDを判別
    if ($this->getProperties('_rooms')->host_user === $_SESSION['me']->id) {
      $client_id = $this->getProperties('_rooms')->invited_user;
    } else {
      $client_id = $this->getProperties('_rooms')->host_user;
    }
    
    track('client_id:' . $client_id);


    //メッセージ情報を取得
    track('メッセージ情報取得');
      $messages = [];
      array_push($messages, $chatModel->getMsgs($_GET['r'], 'create_date'));
    if (!$messages) {
    track('メッセージはまだありません');
      return;
    } else {
      //_messagesにメッセージ情報をセット
      $this->setProperties($messages, '_messages');
      track('メッセージ情報: ' . print_r($messages, true));
      //相手情報を取得
      track('相手情報取得');
        $client = $userModel->getAll('id', $client_id);
        track('相手情報:' . print_r($client, true));
      //_clientsに相手情報をセット
        $this->setProperties($client, '_clients');
    }
  

  } catch (\MyApp\Exception\Query $e) {
    track('クエリ実行に失敗しました');
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
      return;
    }
  }

  protected function postProcess() {
    global $userModel;
    global $chatModel;
  
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

      try {
        //掲示板情報を取得
    track('掲示板情報取得');
    $room = $chatModel->getRoom([
      'id' => $_GET['r']]);
    track('掲示板情報:' . print_r($room, true));
  //_roomsに掲示板情報をセット
    $this->setProperties($room, '_rooms');
    //clientのIDを判別
    if ($this->getProperties('_rooms')->host_user === $_SESSION['me']->id) {
      $client_id = $this->getProperties('_rooms')->invited_user;
    } else {
      $client_id = $this->getProperties('_rooms')->host_user;
    }
    
    track('client_id:' . $client_id);

    track('メッセージ投稿処理開始');
    $chatModel->insertMsg([
      'room_id' => $_GET['r'],
      'from_user' => $_SESSION['me']->id,
      'to_user' => $client_id,
      'msg' => $_POST['text']
    ]);

      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        exit;
      }

      //メッセージ情報を取得
      track('メッセージ情報取得');
      $messages = [];
      array_push($messages, $chatModel->getMsgs($_GET['r'], 'modified_date'));
      if (!$messages) {
      track('メッセージはまだありません');
        return;
    } else {
      //_messagesにメッセージ情報をセット
      $this->setProperties($messages, '_messages');
      track('メッセージ情報: ' . print_r($messages, true));
      //相手情報を取得
      track('相手情報取得');
        $client = $userModel->getAll('id', $client_id);
      track('相手情報:' . print_r($client, true));
      //_clientsに相手情報をセット
        $this->setProperties($client, '_clients');
      }

        //メッセージの格納
        $_SESSION['messages'] = [];
        $_SESSION['messages']['chat'] = SENTMSG;
      //自画面へリダイレクト(更新時にPOST内容の二重投稿防止)
      header('Location:' . $_SERVER['HTTP_REFERER']);

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
    if ($_POST['text'] === '') {
      throw new \MyApp\Exception\EmptyPost();
    }
  }

}