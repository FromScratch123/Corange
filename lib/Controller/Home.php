<?php

namespace MyApp\Controller;

class Home extends \MyApp\Controller {

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
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');
    //friendクラスをインスタンス化
    global $friendModel;
    $friendModel = new \MyApp\Model\Friend();
    //友達情報を取得
    $friends = $friendModel->getFriend($_SESSION['me']->id);
    //_friendsに友達情報をセット
    $this->setProperties($friends, '_friends');
    track('友達情報:' . print_r($friends, true));
    //Workクラスをインスタンス化
    global $workModel;
    $workModel = new \MyApp\Model\Work();
    //自分の投稿を取得
    $_myWork = $workModel->getMyWorks([
      'me' => $_SESSION['me']->id
    ]);
    track('My Project：' . print_r($_myWork, true));
    //_myWorksに自分の投稿をセット
    $this->setProperties($_myWork, '_myWorks');
    //友達の投稿を取得
     $friendsId = [];
     $othersProject = [];
     $where = "";
    for ($i = 0; isset($this->getProperties('_friends')->$i); $i++) {
      array_push($friendsId, $this->getProperties('_friends')->$i->id);
    }
    foreach ($friendsId as $value) {
      $where .= ' work.create_user = ' . $value . ' or';
    }
      $where = substr_replace($where, "", -2);
      $friendWorks = $workModel->getFriendWorks([
        'create_user' => $where
      ]);
           //お気に入り状況追加
           for ($i = 0; isset($friendWorks[$i]); $i++) {
             $isFavorite = $workModel->isFavorite([
               'me' => $_SESSION['me']->id,
               'work_id' => $friendWorks[$i]->work_id
             ]);
              $friendWorks[$i]->isFavorite = $isFavorite;
            //お気に入りの数を追加
             $favoriteNum = $workModel->favoriteNum([
               'work_id' => $friendWorks[$i]->work_id
             ]);
              $friendWorks[$i]->favoriteNum = $favoriteNum;
           }
              track('friendWorks:' . print_r($friendWorks, true));

    // _othersWorksに友達の投稿をセット
    $this->setProperties($friendWorks, '_othersWorks');
    track('othersWorks:' . print_r($friendWorks, true));
  }

}