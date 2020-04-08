<?php

namespace MyApp\Controller;

class FriendList extends \MyApp\Controller {

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
    //カテゴリーを_categoriesにセット
    $categories = $workModel->getCategories();
    $this->setProperties($categories, '_categories');
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');

    try {
    //掲示板情報を取得
      track('友達情報取得');
      $friends = $friendModel->getFriend($_SESSION['me']->id, 'surname', 'DESC');
      track('友達情報:' . print_r($friends, true));
    //_friendsに友達情報をセット
      $this->setProperties($friends, '_friends');

    } catch (\MyApp\Exception\Query $e) {
      track('クエリ実行に失敗しました');
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        return;
    }

  }


}