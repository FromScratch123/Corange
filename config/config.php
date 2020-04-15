<?php 

//================================
//             ログ
//================================
//エラーの表示設定
ini_set('display_errors', 0);
//ログの有無を設定
ini_set('log_errors', 'on');
//ログの出力先を設定
ini_set('error_log', __DIR__ . '/../logs/php.log');
//タイムゾーン変更
date_default_timezone_set('Asia/Tokyo');

//================================
//         ファイル読込
//================================

require_once(__DIR__ . '/../lib/functions.php');
require_once(__DIR__ . '/autoload.php');

//================================
//             定数
//================================

//*********** データべース情報 ***********
define('DSN', 'mysql:host=' . $_SERVER['RDS_HOSTNAME'] . ';dbname=' . $_SERVER['RDS_DB_NAME'] . ';charset=utf8');
define('DB_USERNAME', $_SERVER['RDS_USERNAME']);
define('DB_PASSWORD', $_SERVER['RDS_PASSWORD']);
define('DB_NAME', $_SERVER['RDS_DB_NAME']);
define('OPTIONS', array(
  // SQL実行失敗時にはエラーコードのみ設定
  PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
  // デフォルトフェッチモードを連想配列形式に設定
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  // バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
  // SELECTで得た結果に対してもrowCountメソッドを使えるようにする
  PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
));

//*********** メッセージ ***********
define('WELCOME', 'Welcome to Corange!');
define('WELCOMEBACK', 'Welcomeback to Corange!');
define('MODIFIEDPROFILE', 'プロフィールを変更しました。');
define('CHANGEPASS', 'パスワードを変更しました。');
define('SENTCODE', '認証コードをご登録のメールアドレスへ送信しました。');
define('SENTPASS', 'パスワードをご登録のメールアドレスへ送信しました。');
define('SENTCOMMENT', 'コメントを送信しました。');
define('MODIFIEDWORK', '作品情報を更新しました。');
define('DELETEFRIEND', '友達関係を解除しました。');
define('ACCEPTFRIEND', '友達申請を承認しました。');
define('DELETEWORK', '作品を削除しました。');
define('UPLOADWORK', '作品をアップロードしました。');
define('ASKBEFRIEND', '友達申請を送信しました。');
define('HASASKEDBEFRIEND', '既に友達申請は送信済です。');
define('SENTMSG', 'メッセージを送信しました。');


//*********** その他 ***********
//サイトURL
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);
//最大ファイルサイズ
define('MAX_FILE_SIZE', 10 * 1024 * 1024); //10MB
//ファイル保存先
define('UPLOAD_DIR', './../images/userPost');
//ユーザーアイコンのデフォルトパス
define('DEFAULT_USER_ICON', './../images/default_user_icon.png');
define('DEFAULT_USER_BANNER', './../images/default_user_banner.jpg');
define('DEFAULT_WORK_THUMBNAIL', './../images/default_work_thumbnail.jpg');
//自動メールの送信メールアドレス
define('MAIL_ADDRESS', 'hctarcsmorf@gmail.com');



//============================================
// セッション準備・セッション有効期限を延ばす
//============================================
//セッションファイルの置き場を変更
session_save_path("/var/tmp/");
//ガーベージコレクションが削除するセッションの有効期限の設定
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 30); //30日
//クッキーの有効期限を延長
ini_set('session.cookie_lifetime ', 60 * 60 * 24 * 30); //30日
//セッション開始
session_start();
//セッションIDを再生成
session_regenerate_id();