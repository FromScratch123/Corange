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
    try {
      //自分の投稿を取得
      $myWork = $workModel->getMyWorks([
        'me' => $_SESSION['me']->id
      ]);
      if (!empty($myWork)) {
        //_myWorksに自分の投稿をセット
        $this->setProperties($myWork, '_myWorks');
        track('My Project：' . print_r($myWork, true));
      }

    } catch (\MyApp\Exception\Query $e) {
      track('クエリ実行に失敗しました');
      track('Exception:' . $e->getMessage());
      $this->setErrors('common', $e->getMessage());
      exit;
    }

    if (!empty($_GET)) {
      track('GET送信がありました');
      track('GET内容:' . print_r($_GET, true));
      $this->getProcess();
    } else {
      try {
      track('GET送信はありません');
      track('時間降順で取得します');
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
 private function getProcess() {
  global $userModel;
  global $friendModel;
  global $workModel;

  //作品名昇順
  if (isset($_GET['sort']) && $_GET['sort'] === 'AA') {
    track('作品名昇順で取得します');
    try {
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
        'create_user' => $where,
      ], 'work.title', 'ASC');
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

  //作品名降順
  if (isset($_GET['sort']) && $_GET['sort'] === 'AD') {
    track('作品名降順で取得します');
    try {
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
        'create_user' => $where,
      ], 'work.title', 'DESC');
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

  //時間昇順
  if (isset($_GET['sort']) && $_GET['sort'] === 'DA') {
    track('時間昇順で取得します');
    try {
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
        'create_user' => $where,
      ], 'work.create_date', 'ASC');
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
}