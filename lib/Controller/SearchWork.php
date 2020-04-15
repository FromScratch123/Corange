<?php

namespace MyApp\Controller;

class SearchWork extends \MyApp\Controller {

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
    //友達情報を取得
    $friends = $friendModel->getFriend($_SESSION['me']->id);
    if (!empty($friends)) {
      //_friendsに友達情報をセット
      $this->setProperties($friends, '_friends');
      track('友達情報:' . print_r($friends, true));
    }
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
      if (isset($_GET['sort']) && $_GET['sort'] === 'AD') {
        track('作品名降順で取得します');
        $works = $workModel->getMyWorks([
          'me' => $_SESSION['me']->id
        ], 'work.title', 'DESC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'AA') {
        track('作品名昇順で取得します');
        $works = $workModel->getMyWorks([
          'me' => $_SESSION['me']->id
        ], 'work.title', 'ASC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'DD') {
        track('時間降順で取得します');
        $works = $workModel->getMyWorks([
          'me' => $_SESSION['me']->id
        ], 'work.create_date', 'DESC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'DA') {
        track('時間昇順で取得します');
        $works = $workModel->getMyWorks([
          'me' => $_SESSION['me']->id
        ], 'work.create_date', 'ASC');
      } else {
        track('デフォルト順で取得します');
        $works = $workModel->getMyWorks([
          'me' => $_SESSION['me']->id
        ]);
      }

      for ($i = 0; isset($works->$i->work_id); $i++) {
  
        //お気に入り状況追加
          $isFavorite = $workModel->isFavorite([
            'me' => $_SESSION['me']->id,
            'work_id' => $works->$i->work_id
          ]);
           $works->$i->isFavorite = $isFavorite;
    
        //お気に入りの数を追加
          $favoriteNum = $workModel->favoriteNum([
            'work_id' => $works->$i->work_id
          ]);
          $works->$i->favoriteNum = $favoriteNum;
      }
      //結果を_othersWorksにセット
      $this->setProperties($works, '_othersWorks');
    }
    
    //All Work
    if (isset($_GET['all'])) {
      track('All Workの絞り込みを行います');
      if (isset($_GET['sort']) && $_GET['sort'] === 'AD') {
        track('作品名降順で取得します');
        $works = $workModel->getAllWorks([
          'me' => $_SESSION['me']->id
        ], 'work.title', 'DESC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'AA') {
        track('作品名昇順で取得します');
        $works = $workModel->getAllWorks([
          'me' => $_SESSION['me']->id
        ], 'work.title', 'ASC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'DD') {
        track('時間降順で取得します');
        $works = $workModel->getAllWorks([
          'me' => $_SESSION['me']->id
        ], 'work.create_date', 'DESC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'DA') {
        track('時間昇順で取得します');
        $works = $workModel->getAllWorks([
          'me' => $_SESSION['me']->id
        ], 'work.create_date', 'ASC');
      } else {
        track('デフォルト順で取得します');
        $works = $workModel->getAllWorks([
          'me' => $_SESSION['me']->id
        ]);
      }

      for ($i = 0; isset($works[$i]); $i++) {
        //お気に入り状況追加
          $isFavorite = $workModel->isFavorite([
            'me' => $_SESSION['me']->id,
            'work_id' => $works[$i]->work_id
          ]);
           $works[$i]->isFavorite = $isFavorite;
        //お気に入りの数を追加
          $favoriteNum = $workModel->favoriteNum([
            'work_id' => $works[$i]->work_id
          ]);
          $works[$i]->favoriteNum = $favoriteNum;
      }
      //結果を_othersWorksにセット
      $this->setProperties($works, '_othersWorks');
      track('検索結果:' . print_r($works, true));
    }

    //My Favorite
    if (isset($_GET['favorite'])) {
      track('Favoriteの絞り込みを行います');
      if (isset($_GET['sort']) && $_GET['sort'] === 'AD') {
        track('作品名降順で取得します');
        $works = $workModel->getMyFavorite([
          'me' => $_SESSION['me']->id
        ], 'work.title', 'DESC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'AA') {
        track('作品名昇順で取得します');
        $works = $workModel->getMyFavorite([
          'me' => $_SESSION['me']->id
        ], 'work.title', 'ASC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'DD') {
        track('時間降順で取得します');
        $works = $workModel->getMyFavorite([
          'me' => $_SESSION['me']->id
        ], 'work.create_date', 'DESC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'DA') {
        track('時間昇順で取得します');
        $works = $workModel->getMyFavorite([
          'me' => $_SESSION['me']->id
        ], 'work.create_date', 'ASC');
      } else {
        track('デフォルト順で取得します');
        $works = $workModel->getMyfavorite([
          'me' => $_SESSION['me']->id
        ]);
      }

      for ($i = 0; isset($works[$i]); $i++) {
  
        //お気に入り状況追加
          $isFavorite = $workModel->isFavorite([
            'me' => $_SESSION['me']->id,
            'work_id' => $works[$i]->work_id
          ]);
           $works[$i]->isFavorite = $isFavorite;
    
        //お気に入りの数を追加
          $favoriteNum = $workModel->favoriteNum([
            'work_id' => $works[$i]->work_id
          ]);
          $works[$i]->favoriteNum = $favoriteNum;
      }
      //結果を_othersWorksにセット
      $this->setProperties($works, '_othersWorks');
      track('検索結果:' . print_r($works, true));
    }

    //Trash
    if (isset($_GET['trash'])) {
      track('Trachの絞り込みを行います');
      if (isset($_GET['sort']) && $_GET['sort'] === 'AD') {
        track('作品名降順で取得します');
        $works = $workModel->getTrash([
          'me' => $_SESSION['me']->id
        ], 'work.title', 'DESC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'AA') {
        track('作品名昇順で取得します');
        $works = $workModel->getTrash([
          'me' => $_SESSION['me']->id
        ], 'work.title', 'ASC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'DD') {
        track('時間降順で取得します');
        $works = $workModel->getTrash([
          'me' => $_SESSION['me']->id
        ], 'work.create_date', 'DESC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'DA') {
        track('時間昇順で取得します');
        $works = $workModel->getTrash([
          'me' => $_SESSION['me']->id
        ], 'work.create_date', 'ASC');
      } else {
        track('デフォルト順で取得します');
        $works = $workModel->getTrash([
          'me' => $_SESSION['me']->id
        ]);
      }

      for ($i = 0; isset($works[$i]); $i++) {
  
        //お気に入り状況追加
          $isFavorite = $workModel->isFavorite([
            'me' => $_SESSION['me']->id,
            'work_id' => $works[$i]->work_id
          ]);
           $works[$i]->isFavorite = $isFavorite;
    
        //お気に入りの数を追加
          $favoriteNum = $workModel->favoriteNum([
            'work_id' => $works[$i]->work_id
          ]);
          $works[$i]->favoriteNum = $favoriteNum;
      }
      //結果を_othersWorksにセット
      $this->setProperties($works, '_othersWorks');
      track('検索結果:' . print_r($works, true));
    }

    //Category
    if (!empty($_GET['category'])) {
      track('カテゴリーによる絞り込みを行います');
      if (isset($_GET['sort']) && $_GET['sort'] === 'AD') {
        track('作品名降順で取得します');
        $works = $workModel->getWorkByCategory([
          'id' => $_GET['category']
        ], 'work.title', 'DESC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'AA') {
        track('作品名昇順で取得します');
        $works = $workModel->getWorkByCategory([
          'id' => $_GET['category']
        ], 'work.title', 'ASC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'DD') {
        track('時間降順で取得します');
        $works = $workModel->getWorkByCategory([
          'id' => $_GET['category']
        ], 'work.create_date', 'DESC');
      } elseif (isset($_GET['sort']) && $_GET['sort'] === 'DA') {
        track('時間昇順で取得します');
        $works = $workModel->getWorkByCategory([
          'id' => $_GET['category']
        ], 'work.create_date', 'ASC');
      } else {
        track('デフォルト順で取得します');
          //指定カテゴリーの作品を取得
          $works = $workModel->getWorkByCategory([
            'id' => $_GET['category']
          ]);
      }
  
      for ($i = 0; isset($works[$i]); $i++) {
  
        //お気に入り状況追加
          $isFavorite = $workModel->isFavorite([
            'me' => $_SESSION['me']->id,
            'work_id' => $works[$i]->work_id
          ]);
           $works[$i]->isFavorite = $isFavorite;
    
        //お気に入りの数を追加
          $favoriteNum = $workModel->favoriteNum([
            'work_id' => $works[$i]->work_id
          ]);
          $works[$i]->favoriteNum = $favoriteNum;
      }
      //結果を_othersWorksにセット
      $this->setProperties($works, '_othersWorks');
      track('検索結果:' . print_r($works, true));
    }

    //Search
    if (!empty($_GET['search'])) {
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
        for ($i = 0; isset($works[$i]); $i++) {
          $work = $workModel->getWork([
            'work_id' => $works[$i]->work_id
          ]);
          //お気に入り状況追加
            $isFavorite = $workModel->isFavorite([
              'me' => $_SESSION['me']->id,
              'work_id' => $works[$i]->work_id
            ]);
             $works[$i]->isFavorite = $isFavorite;
      
          //お気に入りの数を追加
            $favoriteNum = $workModel->favoriteNum([
              'work_id' => $works[$i]->work_id
            ]);
            $works[$i]->favoriteNum = $favoriteNum;
        }
        //検索結果を_othersWorksにセット
        $this->setProperties($works, '_othersWorks');
      }
      track('検索結果:' . print_r($works, true));
    }
  }
  

}