<?php 


//================================
//            ログ
//================================

//ログに出力
$track_flg = true;
function track($str) {
  global $track_flg;
  if ($track_flg) {
    error_log('track：' . $str);
  }
}

//基本情報出力
function trackingStart(){
  track('-------画面表示処理開始-------');
  track('訪問ページ:' . $_SERVER['REQUEST_URI']);
  track('セッションID：'.session_id());
  track('セッション変数の中身：' . print_r($_SESSION, true));
  track('処理開始日時：' . date('Y年m月d日 H時i
分s秒'));
  if(!empty($_SESSION['login_date']) && !empty($_SESSION['login_limit'])){
    track( 'ログイン有効期限：' . ( $_SESSION['login_date'] + $_SESSION['login_limit'] ) );
  }
}

//================================
//          セキュリティ
//================================
//特殊文字の変換
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}