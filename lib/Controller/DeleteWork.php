<?php

namespace MyApp\Controller;

class DeleteWork extends \MyApp\Controller {

  //loginの有無確認
  public function run() {
    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/Corange/public_html/index.php');
      exit;
    } 
      
    //Userクラスをインスタンス化
    global $userModel;
    $userModel = new \MyApp\Model\User();
    //workクラスをインスタンス化
    global $workModel;
    $workModel = new \MyApp\Model\Work();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      track('GET送信がありました');
      $this->getProcess();
    }

  }

  public function getProcess() {
      global $userModel;
      global $workModel;
    try {
      //作品削除処理
        track('作品削除処理開始');
        $workModel->delete([
          'work_id' => $_GET['w'],
          'me' => $_SESSION['me']->id
        ]);
  
      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
          track('Exception:' . $e->getMessage());
          $this->setErrors('common', $e->getMessage());
          return;
      }
      track('作品削除処理完了');
      $_SESSION['messages'] = [];
      $_SESSION['messages']['home'] = DELETEWORK;
      track('home.phpへ遷移します');
      header('Location:' .SITE_URL . '/Corange/public_html/home.php');
  }  

}