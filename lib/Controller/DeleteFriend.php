<?php

namespace MyApp\Controller;

class DeleteFriend extends \MyApp\Controller {

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
      $this->getProcess();
    }

  }

  public function getProcess() {
      global $userModel;
      global $friendModel;
    try {
      //友達解除処理
        track('友達解除処理開始');
        $friendModel->delete([
          'me' => $_SESSION['me']->id,
          'friend' => $_GET['u']
        ]);
  
      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
          track('Exception:' . $e->getMessage());
          $this->setErrors('common', $e->getMessage());
          return;
      }
      track('友達解除処理完了');
      track('friendList.phpへ遷移します');
      header('Location:' .SITE_URL . '/Duplazy/public_html/friendList.php');
  }  

}