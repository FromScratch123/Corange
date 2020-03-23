
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
    <?php if (isset($app->getProperties('_clients')->profile_img)) : ?>
    <!-- client infomation -->
    <table class="client-info">
      <tbody>
        <tr>
         <td class="client-info__icon">
            <!-- user icon -->
            <div class="chat__client-icon-wrap">
                      <img src="<?= isset($app->getProperties('_clients')->profile_img) ? h($app->getProperties('_clients')->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="chat__client-icon">
            </div>
        </td>
        <td>
          <p class="client-info__name"><?= isset($app->getProperties('_clients')->surname) && isset($app->getProperties('_clients')->givenname) ? h($app->getProperties('_clients')->surname) . " " . h($app->getProperties('_clients')->givenname) : "" ?>
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
            <time><?= isset($app->getProperties('_messages')->{0}[$i]->modified_date) ? date('H:i', strtotime(h($app->getProperties('_messages')->{0}[$i]->modified_date))) : "" ?></time>
          </td>
        </tr>
      </table>
    </div>
    <?php endif; ?>
    <?php if ($app->getProperties('_messages')->{0}[$i]->to_user === $_SESSION['me']->id) : ?>
    <!-- client use -->
    <div class="chat-box">
      <table class="chat-table--right">
        <!-- 1行目 -->
        <tr>
        <td class="time">
            <time datetime="hh:mm"><?= isset($app->getProperties('_messages')->{0}[$i]->modified_date) ? date('H:i', strtotime(h($app->getProperties('_messages')->{0}[$i]->modified_date))) : "" ?></time>
          </td>
          <td class="chat--right">
          <?= isset($app->getProperties('_messages')->{0}[$i]->msg) ? h($app->getProperties('_messages')->{0}[$i]->msg) : "" ?>
          </td>
          <td class="user-icon">
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
        <textarea class="chat-textarea" name="text" id="text"></textarea>
      </p>
        <input class="chat-submit" type="submit" value="送信">
    </form>

  </div>
 
  
</main>
</body>
</html>