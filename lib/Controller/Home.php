<?php

namespace MyApp\Controller;

class Home extends \MyApp\Controller {

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
    $myWorks = $workModel->getMyWork([
      'me' => $_SESSION['me']->id
    ]);
    //_myWorksに自分の投稿をセット
    $this->setProperties($myWorks, '_myWorks');
    //友達の投稿を取得
     global $friendWorks;
    for ($i = 0; isset($this->getProperties('_friends')->$i); $i++) {
      global $friendWorks;
      $friendWorks[] = $workModel->getFriendWork([
        'create_user' => $this->getProperties('_friends')->$i->id
      ]);
    }
    //_friendWorks友達の投稿をセット
    $this->setProperties($friendWorks, '_friendWorks');
    track('friendworks:' . print_r($friendWorks, true));

  }
}