<?php

namespace MyApp\Controller;

class SearchFriend extends \MyApp\Controller {

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
    //friendクラスをインスタンス化
    global $friendModel;
    $friendModel = new \MyApp\Model\Friend();
    //Workクラスをインスタンス化
    global $workModel;
    $workModel = new \MyApp\Model\Work();
    //カテゴリーを_categoriesにセット
    $categories = $workModel->getCategories();
    $this->setProperties($categories, '_categories');
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');

    if (!empty($_GET)) {
      track('GET送信がありました');
      track('GET内容:' . print_r($_GET, true));
      $this->getProcess();
    }

  }


  private function getProcess() {
    global $userModel;
    global $friendModel;
    //空白文字を取り除く
    $search = str_replace(array(" ", "　"), '', $_GET['search']);
    track('検索ワード変更前:' . $_GET['search'] . '検索ワード変更後:' . $search);
    //検索結果を取得
    $users = $userModel->search([
      'search' => $search,
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