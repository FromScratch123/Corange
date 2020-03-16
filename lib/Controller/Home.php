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
  
    //Userクラスをインスタンス化
    global $userModel;
    $userModel = new \MyApp\Model\User();
    //Uploadクラスをインスタンス化
    global $uploadModel;
    $uploadModel = new \MyApp\Model\Upload();
    //インスタンスの_Propertiesにユーザーの属性をセット
    $userModel->setProperties($_SESSION['me']);
    //ユーザーの属性を取得
    $userProperties = $userModel->getProperties();
    //ユーザーの属性を値にセット
    $this->setValues($userProperties);
 
  }
}