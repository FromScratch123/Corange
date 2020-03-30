<?php 

//================================
//             ログ
//================================
//エラーの表示設定
ini_set('display_errors', 1);
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
define('DSN', 'mysql:dbhost=localhost;dbname=Duplazy;charset=utf8');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
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
define('WELCOME', 'Welcome to Duplazy!');
define('WELCOMEBACK', 'Welcomeback to Duplazy!');
define('MODIFIEDPROFILE', 'プロフィールを変更しました。');
define('CHANGEPASS', 'パスワードを変更しました。');
define('SENDCODE', '認証コードをご登録のメールアドレスへ送信しました。');
define('SENDPASS', 'パスワードをご登録のメールアドレスへ送信しました。');

//*********** その他 ***********
//サイトURL
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);
//最大ファイルサイズ
define('MAX_FILE_SIZE', 3 * 1024 * 1024); //3MB
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