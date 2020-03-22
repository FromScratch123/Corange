<?php

namespace MyApp\Controller;

class AcceptFriend extends \MyApp\Controller {

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
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      track('GET送信がありました');
      $this->postProcess();
    }

  }

  public function postProcess() {
      global $userModel;
      global $friendModel;
    try {
      //友達承諾処理
        track('友達申請承諾処理開始');
        $friendModel->accept([
          'follow_user' => $_GET['u'],
          'followed_user' => $_SESSION['me']->id
        ]);
  
      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
          track('Exception:' . $e->getMessage());
          $this->setErrors('common', $e->getMessage());
          return;
      }
      track('友達申請承諾処理完了');
      track('friendList.phpへ遷移します');
      header('Location:' .SITE_URL . '/Duplazy/public_html/friendList.php');
  }  

}