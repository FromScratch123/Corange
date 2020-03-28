<?php

namespace MyApp\Controller;

class ChatRead extends \MyApp\Controller {


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
    //Chatクラスをインスタンス化
    global $chatModel;
    $chatModel = new \MyApp\Model\Chat();
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
    global $chatModel;

    //既読状況確認
    if (!$chatModel->isRead([
      'id' => $_POST['messageId']
    ])) {
      //未読の場合
      track('未読メッセージです');
      try {
        //自身のメッセージか確認
        $msg = $chatModel->getMsg([
      'id' => $_POST['messageId']
       ]);
       if (!$msg) {
         //idが不正の場合
         track('メッセージを取得出来ません');
         exit;
       } else if ($msg->from_user === $_SESSION['me']->id) {
         track('id:' . $_POST['messageId'] . 'from_user:' . $msg->from_user . '自身:' . $_SESSION['me']->id);
         //自身のメッセージの場合
         track('自身のメッセージです');
         exit;
      } else {
        //相手のメッセージの場合
          track('メッセージを既読にします');
           $chatModel->hasRead([
             'id' => $_POST['messageId']
           ]);
       }
      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        return;
      }
    } else {
      //既読の場合
      track('既に既読のメッセージです');
      return;
    }
  
  }

}