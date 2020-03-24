<?php

namespace MyApp\Controller;

class Profile extends \MyApp\Controller {

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
    //friendクラスをインスタンス化
    global $friendModel;
    $friendModel = new \MyApp\Model\Friend();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      track('GET送信がありました');
      track('GET内容:' . print_r($_GET, true));
      $this->getProcess();
    }


  }

  private function getProcess() {
    global $userModel;
    global $friendModel;
    try {
      $user = $userModel->getProfile([
        'id' => $_GET['u']
      ]);

    } catch (\MyApp\Exception\Query $e) {
      track('クエリ実行に失敗しました');
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
      exit;
    }

    //取得したprofile情報を_friendにセット
    $this->setProperties($user, '_friends');
    track('ユーザー情報:' . print_r($user, true));
  }

}