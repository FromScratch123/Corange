<?php

namespace MyApp\Controller;

class AskBeFriend extends \MyApp\Controller {

  //loginの有無確認
  public function run() {
    if (!$this->isLoggedIn()) {
      track('【ログイン未】index.phpへ遷移します');
      header('Location:' . SITE_URL . '/Corange/public_html/index.php');
      exit;
    } 
      
    //Userクラスをインスタンス化
    global $userModel;
    $userModel = new \MyApp\Model\User();
    //friendクラスをインスタンス化
    global $friendModel;
    $friendModel = new \MyApp\Model\Friend();
    //_usersにユーザーの属性をセット
    $this->setProperties($_SESSION['me'], '_users');

    if (!empty($_GET)) {
      track('GET送信がありました');
      track('GET送信内容: ' . print_r($_GET, true));
      $this->getProcess();
    }

  }

  public function getProcess() {
      global $userModel;
      global $friendModel;
    try {
      //友達状態確認
        track('友達状態確認');
        $isFriend = $friendModel->isFriend([
          'me' => $_SESSION['me']->id,
          'client' => $_GET['u']
        ]);
        if ($isFriend) {
          track('既に友達関係です');
          track('遷移元ページへ遷移します');
          header('Location:' . $_SERVER['HTTP_REFERER']);
          return;
        } 
      //友達申請処理
        track('友達申請処理開始');
        $friendModel->beFriend([
          'follow_user' => $_SESSION['me']->id,
          'followed_user' => $_GET['u']
        ]);
  
      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
          track('Exception:' . $e->getMessage());
          $this->setErrors('common', $e->getMessage());
          return;
      }
      track('友達申請処理完了');
      track('遷移元ページへ遷移します');
      header('Location:' . $_SERVER['HTTP_REFERER']);
  }  

}