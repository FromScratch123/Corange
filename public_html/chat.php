
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\Chat();
  $app->run();
  $upload = new MyApp\Controller\UploadWork();
  $upload->run();
  $requestPage = 'CHAT -';
  $jsPath1 = './../js/chat.js';
  $jsPath2 = './../js/aside.js';
  $jsPath3 = './../js/uploadWork.js';
  $jsPath4 = '';
  $CSSPath1 = './../CSS/chat.css';
  $CSSPath2 = './../CSS/accountField.css';
  $CSSPath3 = './../CSS/aside.css';
  $CSSPath4 = './../CSS/uploadWork.css';
  
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
    <?php require_once(__DIR__ . '/uploadWork.php'); ?>
    <?php if (isset($app->getProperties('_clients')->profile_img)) : ?>
    <!-- client infomation -->
    <table class="client-info">
      <tbody>
        <tr>
         <td class="client-info__icon">
            <!-- user icon -->
            <a href="./profile.php?u=<?= isset($app->getProperties('_clients')->id) ? h($app->getProperties('_clients')->id) : ""; ?>">
            <div class="chat__client-icon-wrap">
                      <img src="<?= isset($app->getProperties('_clients')->profile_img) ? h($app->getProperties('_clients')->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="chat__client-icon">
            </div>
            </a>
        </td>
        <td>
          <p class="client-info__name">
          <a href="./profile.php?u=<?= isset($app->getProperties('_clients')->id) ? h($app->getProperties('_clients')->id) : ""; ?>">  
          <?= isset($app->getProperties('_clients')->surname) && isset($app->getProperties('_clients')->givenname) ? h($app->getProperties('_clients')->surname) . " " . h($app->getProperties('_clients')->givenname) : "" ?>
          </a>
          </p>
        </td> 
      </tr>
      </tbody>
    </table>
    <?php endif; ?>

    <?php for ($i = 0; isset($app->getProperties('_messages')->{0}[$i]->id); $i++) : ?>
    <?php if ($app->getProperties('_messages')->{0}[$i]->from_user === $_SESSION['me']->id) : ?>
    <div class="chat-box">
      <table class="chat-table--left">
        <!-- 1行目 -->
        <tr>
          <td class="user-icon">
            <!-- user icon -->
            <div class="chat__user-icon-wrap">
                <img src="<?= isset($app->getProperties('_users')->profile_img) ? h($app->getProperties('_users')->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="chat__user-icon">
              </div>
          </td>
          <td class="chat--left">
            <?= isset($app->getProperties('_messages')->{0}[$i]->msg) ? h($app->getProperties('_messages')->{0}[$i]->msg) : "" ?>
          </td>
          <td class="time">
            <time><?= isset($app->getProperties('_messages')->{0}[$i]->create_date) ? date('H:i', strtotime(h($app->getProperties('_messages')->{0}[$i]->create_date))) : "" ?></time>
            <p class="margin--0">
          <?= $app->getProperties('_messages')->{0}[$i]->open_flg == 0 ? 'unread' : 'read'; ?>
          </p>
          </td>
        </tr>
      </table>
    </div>
    <?php endif; ?>

    <?php if ($app->getProperties('_messages')->{0}[$i]->to_user === $_SESSION['me']->id) : ?>
    <!-- client use -->
    <div class="chat-box">
      <table class="chat-table--right" data-message-id="<?= $app->getProperties('_messages')->{0}[$i]->id ?>">
        <!-- 1行目 -->
        <tr>
        <td class="time">
            <time datetime="hh:mm"><?= isset($app->getProperties('_messages')->{0}[$i]->create_date) ? date('H:i', strtotime(h($app->getProperties('_messages')->{0}[$i]->create_date))) : "" ?></time>
          </td>
          <td class="chat--right" rowspan="2">
          <?= isset($app->getProperties('_messages')->{0}[$i]->msg) ? h($app->getProperties('_messages')->{0}[$i]->msg) : "" ?>
          </td>
          <td class="user-icon" rowspan="2">
            <!-- user icon -->
            <div class="chat__user-icon-wrap">
                <img src="<?= isset($app->getProperties('_clients')->profile_img) ? h($app->getProperties('_clients')->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="chat__user-icon">
              </div>
          </td>
        </tr>
      </table>
    </div>
    <?php endif; ?>
    <?php endfor; ?>
    

    <form class="chat-textarea-wrap" action="" method="post">
      <!-- token -->
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <p class="has-error margin--0"><?= $app->getErrors('empty'); ?></p>
      <!-- textarea -->
      <p>
        <textarea class="chat-textarea" name="text"></textarea>
      </p>
        <input class="chat-submit" type="submit" value="送信">
    </form>

  </div>
 
  
</main>
</body>
</html>