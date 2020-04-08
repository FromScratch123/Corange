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
    try {
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
    //Workクラスをインスタンス化
    global $workModel;
    $workModel = new \MyApp\Model\Work();
    //カテゴリーを_categoriesにセット
    $categories = $workModel->getCategories();
    $this->setProperties($categories, '_categories');
    //友達情報を取得
    $friends = $friendModel->getFriend($_SESSION['me']->id);
    if (!empty($friends)) {
      //_friendsに友達情報をセット
      $this->setProperties($friends, '_friends');
      track('友達情報:' . print_r($friends, true));
    }
    //Workクラスをインスタンス化
    global $workModel;
    $workModel = new \MyApp\Model\Work();
    //自分の投稿を取得
    $myWork = $workModel->getMyWorks([
      'me' => $_SESSION['me']->id
    ]);
    if (!empty($myWork)) {
      //_myWorksに自分の投稿をセット
      $this->setProperties($myWork, '_myWorks');
      track('My Project：' . print_r($myWork, true));
    }
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

    if (!empty($friendWorks)) {
      // _othersWorksに友達の投稿をセット
      $this->setProperties($friendWorks, '_othersWorks');
      track('othersWorks:' . print_r($friendWorks, true));
    }
  } catch (\MyApp\Exception\Query $e) {
    track('クエリ実行に失敗しました');
    track('Exception:' . $e->getMessage());
    $this->setErrors('common', $e->getMessage());
    exit;
  }
 }

}