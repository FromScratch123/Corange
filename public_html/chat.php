
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\Chat();
  $app->run();
  $requestPage = 'CHAT -';
  $jsPath = './../js/chat.js';
  $CSSPath1 = './../CSS/chat.css';
  $CSSPath2 = './../CSS/accountField.css';
  $CSSPath3 = './../CSS/aside.css';
  
  require_once(__DIR__ . '/head.php');

  ?>

<body>
<?php 
$logoPath = './home.php';
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/accountField.php');
require_once(__DIR__ . '/aside.php');
 ?>


  
<main>
  <!-- host user -->
  <div class="chat-window">
    <div class="chat-box">
      <table class="chat-table--left">
        <!-- 1行目 -->
        <tr>
          <td class="user-icon">
            <!-- user icon -->
            <div class="chat__user-icon-wrap">
                <img src="<?= isset($app->getValues()->profile_img) ? h($app->getValues()->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="chat__user-icon">
              </div>
          </td>
          <td class="chat--left">
            お世話になっております。
            先日打ち合わせさせていただきました件ですが、何か進展ございましたでしょうか？
          </td>
          <td class="time">
            <time>14:50</time>
          </td>
        </tr>
      </table>
    </div>

    <!-- client use -->
    <div class="chat-box">
      <table class="chat-table--right">
        <!-- 1行目 -->
        <tr>
        <td class="time">
            <time>14:50</time>
          </td>
          <td class="chat--right">
            もうしばらくお待ちください。
            デザイン案が上がり次第お知らせ致します。
          </td>
          <td class="user-icon">
            <!-- user icon -->
            <div class="chat__user-icon-wrap">
                <img src="<?= isset($app->getValues()->profile_img) ? h($app->getValues()->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="chat__user-icon">
              </div>
          </td>
        </tr>
      </table>
    </div>

    <!-- client use -->
    <div class="chat-box">
      <table class="chat-table--right">
        <!-- 1行目 -->
        <tr>
        <td class="time">
            <time>14:50</time>
          </td>
          <td class="chat--right">
            もうしばらくお待ちください。
            デザイン案が上がり次第お知らせ致します。
          </td>
          <td class="user-icon">
            <!-- user icon -->
            <div class="chat__user-icon-wrap">
                <img src="<?= isset($app->getValues()->profile_img) ? h($app->getValues()->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="chat__user-icon">
              </div>
          </td>
        </tr>
      </table>
    </div>

    <!-- client use -->
    <div class="chat-box">
      <table class="chat-table--right">
        <!-- 1行目 -->
        <tr>
        <td class="time">
            <time>14:50</time>
          </td>
          <td class="chat--right">
            もうしばらくお待ちください。
            デザイン案が上がり次第お知らせ致します。
          </td>
          <td class="user-icon">
            <!-- user icon -->
            <div class="chat__user-icon-wrap">
                <img src="<?= isset($app->getValues()->profile_img) ? h($app->getValues()->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="chat__user-icon">
              </div>
          </td>
        </tr>
      </table>
    </div>

    <!-- client use -->
    <div class="chat-box">
      <table class="chat-table--right">
        <!-- 1行目 -->
        <tr>
        <td class="time">
            <time>14:50</time>
          </td>
          <td class="chat--right">
            もうしばらくお待ちください。
            デザイン案が上がり次第お知らせ致します。
          </td>
          <td class="user-icon">
            <!-- user icon -->
            <div class="chat__user-icon-wrap">
                <img src="<?= isset($app->getValues()->profile_img) ? h($app->getValues()->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="chat__user-icon">
              </div>
          </td>
        </tr>
      </table>
    </div>

    <form class="chat-textarea-wrap" action="" method="post">
      <!-- token -->
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <p class="has-error margin--0"><?= $app->getErrors('empty'); ?></p>
      <!-- textarea -->
      <p>
        <textarea class="chat-textarea" name="text" id="text"></textarea>
      </p>
        <input class="chat-submit" type="submit" value="送信">
    </form>

  </div>
 
  
</main>
</body>
</html>