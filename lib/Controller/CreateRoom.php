<?php

namespace MyApp\Controller;

class CreateRoom extends \MyApp\Controller {

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
    //friendクラスをインスタンス化
    global $friendModel;
    $friendModel = new \MyApp\Model\Friend();
    //chatクラスをインスタンス化
    global $chatModel;
    $chatModel = new \MyApp\Model\Chat();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      track('GET送信がありました');
      track('GETパラメーター:' . $_GET['u']);
      $this->getProcess();
    }

  }

  public function getProcess() {
      global $userModel;
      global $friendModel;
      global $chatModel;

      //掲示板の存在確認
      $room = $chatModel->isExistRoom([
        'me' => $_SESSION['me']->id,
        'friend' => $_GET['u']
      ]);

      track('掲示板情報: ' . print_r($room, true));

      if (!$room) {
        try {
          track('掲示板はまだ存在していません');
          //掲示板作成処理
            track('掲示板作成処理開始');
            $room_id = $chatModel->createRoom([
              'host_user' => $_SESSION['me']->id,
              'invited_user' => $_GET['u']
            ]);

          } catch (\MyApp\Exception\Query $e) {
            track('クエリ実行に失敗しました');
              track('Exception:' . $e->getMessage());
              $this->setErrors('common', $e->getMessage());
              return;
          }

          track('掲示板作成処理完了');
          track('chat.phpへ遷移します');
          header('Location:' .SITE_URL . '/Duplazy/public_html/chat.php?r=' . $room_id);

      } else {

        track('掲示板が既に存在しています');
        track('指定掲示板へ遷移します');
        header('Location:' . SITE_URL . '/Duplazy/public_html/chat.php?r=' . $room[0]->id);
        exit;
      }
     
      
  }  

}