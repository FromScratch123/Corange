<?php

namespace MyApp\Controller;

class Chat extends \MyApp\Controller {

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
    //Uploadクラスをインスタンス化
    global $uploadModel;
    $chatModel = new \MyApp\Model\Chat();
    //インスタンスの_Propertiesにユーザーの属性をセット
    $userModel->setProperties($_SESSION['me']);
    //ユーザーの属性を取得
    $userProperties = $userModel->getProperties();
    //ユーザーの属性を値にセット
    $this->setValues($userProperties);
 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      track('POST送信がありました');
      track('POST内容:' . print_r($_POST, true));
      $this->postProcess();
    }

  }

  protected function postProcess() {
    global $userModel;
    global $MessageModel;

    try {
      track('バリデーション開始');
      $this->_validate();
    } catch (\MyApp\Exception\EmptyPost $e) {
      track('必須項目が未入力です');
      track('Exception:' . $e->getMessage());
      $this->setErrors('empty', $e->getMessage());
    }
    
    //POSTされた値を保持(変更前の値ではなくPOSTの値を優先)
    $this->setValues($_POST);

    if ($this->hasError()) {
      return;
    } else {
      track('バリデーションクリア');

      try {
        track('メッセージ投稿処理開始');
        $MessageModel->insert([
          'room_id' => $_SESSION['room']->id,
          'from_user' => $_SESSION['me']->id,
          'to_user' => $_SESSION['room']->to_user,
          'msg' => $_POST['text']
        ]);

      } catch (\MyApp\Exception\Query $e) {
        track('クエリ実行に失敗しました');
        track('Exception:' . $e->getMessage());
        $this->setErrors('common', $e->getMessage());
        exit;
      }
    }
  }

  private function _validate() {
     //tokenの確認
     if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      track('tokenが不正です');
      echo "Invalid Token!";
      exit;
    }
    //必須項目確認
    if ($_POST['text'] === '') {
      throw new \MyApp\Exception\EmptyPost();
    }
  }


}