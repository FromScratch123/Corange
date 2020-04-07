<?php

namespace MyApp\Controller;

class SearchWork extends \MyApp\Controller {

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
    //friendクラスをインスタンス化
    global $friendModel;
    $friendModel = new \MyApp\Model\Friend();
    //Workクラスをインスタンス化
    global $workModel;
    $workModel = new \MyApp\Model\Work();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');

    if (isset($_GET)) {
      track('GET送信がありました');
      track('GET内容:' . print_r($_GET, true));
      $this->getProcess();
    }

  }


  private function getProcess() {
    global $userModel;
    global $friendModel;
    global $workModel;

    //My Work
    if (isset($_GET['my'])) {
      track('My Workの絞り込みを行います');
      $works = $workModel->getMyWorks([
        'me' => $_SESSION['me']->id
      ]);
      //結果を_othersWorksにセット
      $this->setProperties($works, '_othersWorks');
    }
    
    //All Work
    if (isset($_GET['all'])) {
      track('All Workの絞り込みを行います');
      $works = $workModel->getAllWorks([
        'me' => $_SESSION['me']->id
      ]);
      //結果を_othersWorksにセット
      $this->setProperties($works, '_othersWorks');
      track('検索結果:' . print_r($works, true));
    }

    //My Favorite
    if (isset($_GET['favorite'])) {
      track('Favoriteの絞り込みを行います');
      $works = $workModel->getMyfavorite([
        'me' => $_SESSION['me']->id
      ]);
      //結果を_othersWorksにセット
      $this->setProperties($works, '_othersWorks');
      track('検索結果:' . print_r($works, true));
    }

    //Trash
    if (isset($_GET['trash'])) {
      track('Trachの絞り込みを行います');
      $works = $workModel->getTrash([
        'me' => $_SESSION['me']->id
      ]);
      //結果を_othersWorksにセット
      $this->setProperties($works, '_othersWorks');
      track('検索結果:' . print_r($works, true));
    }

    //Search
    if (isset($_GET['search'])) {
      //空白文字を取り除く
      $search = str_replace(array(" ", "　"), '', $_GET['search']);
      track('検索ワード変更前:' . $_GET['search'] . '検索ワード変更後:' . $search);
      //検索結果を取得
      $works = $workModel->search([
        'search' => $search,
      ]);     
      if (!$works) {
        return;
      } else {
        //検索結果を_othersWorksにセット
        $this->setProperties($works, '_othersWorks');
      }
      track('検索結果:' . print_r($works, true));
    }
  }
  

}