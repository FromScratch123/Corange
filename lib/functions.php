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
  if (isset($_SERVER['HTTP_REFERER'])) {
    track('訪問元ページ:' . $_SERVER['HTTP_REFERER']);
  } else {
    track('訪問元ページは検出出来ませんでした');
  }
  track('訪問先ページ:' . $_SERVER['REQUEST_URI']);
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

//================================
//          mail送信
//================================

function sendMail($from, $to, $subject, $text){
  if(!empty($to) && !empty($subject) && !empty($text)){
      //文字化け回避設定
      mb_language("Japanese"); 
      mb_internal_encoding("UTF-8"); 
      //メール送信
      $result = mb_send_mail($to, $subject, $text, "From: " . $from);
      //送信結果を判定
      if ($result) {
        track('メールを送信しました');
        return true;
      } else {
        track('メールの送信に失敗しました');
        throw new \MyApp\Exception\FaildSendMail();
      }
  }
}

//================================
//          その他
//================================

// 乱数生成
function random($length) {
  return bin2hex(openssl_random_pseudo_bytes($length));
}
