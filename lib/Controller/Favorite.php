<?php

namespace MyApp\Controller;

class Favorite extends \MyApp\Controller {


  //loginの有無確認
  public function run() {
    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/public_html/index.php');
      exit;
    } 

    //Userクラスをインスタンス化
    global $userModel;
    $userModel = new \MyApp\Model\User();
    //Workクラスをインスタンス化
    global $workModel;
    $workModel = new \MyApp\Model\Work();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      track('POST送信がありました');
      track('POST内容:' . print_r($_POST, true));
      $this->postProcess();
    }

  }


  protected function postProcess() {
    global $userModel;
    global $workModel;
    //お気に入り登録状況確認
    $isFavorite = $workModel->isFavorite([
      'me' => $_SESSION['me']->id,
      'work_id' => $_POST['work_id']
    ]);

    try {
    if ($isFavorite > 0) {
      //お気に入り登録されている場合(お気に入り解除)
      track('お気に入り登録されています');
      $workModel->deleteFavorite([
        'register_user' => $_SESSION['me']->id,
        'create_user' => $_POST['create_user'],
        'work_id' => $_POST['work_id']
      ]);
      track('お気に入り登録を解除しました');
    } else {
      //お気に入りに登録されていない場合（お気に入り登録）
      track('お気に入りに登録されていません');
      $workModel->insertFavorite([
        'register_user' => $_SESSION['me']->id,
        'create_user' => $_POST['create_user'],
        'work_id'  => $_POST['work_id']
      ]);
      track('お気に入りに登録しました');
    }
  } catch (\MyApp\Exception\Query $e) {
    track('クエリ実行に失敗しました');
    track('Exception:' . $e->getMessage());
    $this->setErrors('common', $e->getMessage());
    exit;
  }

}

}