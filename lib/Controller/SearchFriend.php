<?php

namespace MyApp\Controller;

class SearchFriend extends \MyApp\Controller {

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
      $this->postProcess();
    }

  }


  private function postProcess() {
    global $userModel;
    global $friendModel;
    $users = $userModel->search([
      'search' => $_GET['search'],
      'id' => $_SESSION['me']->id
    ]);
 
      
    if (!$users) {
      return;
    } else {

      //友達状態を判定
      for ($i = 0; isset($users[$i]); $i++) {
        $isFriend = $friendModel->isFriend([
          'me' => $_SESSION['me']->id,
          'client' => $users[$i]->id
        ]);
        $users[$i]->isFriend = $isFriend;
        $isAsked = $friendModel->isAsked([
          'me' => $_SESSION['me']->id,
          'client' => $users[$i]->id
        ]);
        $users[$i]->isAsked = $isAsked;
      }
      //検索結果を_friendsにセット
      $this->setProperties($users, '_friends');
    }
    track('検索結果:' . print_r($users, true));
  }
  

}