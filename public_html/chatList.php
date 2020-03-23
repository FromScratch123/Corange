
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\ChatList();
  $app->run();
  $requestPage = 'CHAT LIST -';
  $jsPath = './../js/chatlist.js';
  $CSSPath1 = './../CSS/chatList.css';
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
$message = ['id' => 1];
 ?>


  
<main>
  <div class="chat-list-window">
  <!-- NOTHING TO SHOW -->
  <?php if (!isset($app->getProperties('_rooms')->{0}->id)) : ?>
    <div class="no-show">
      <p>Nothing to show...</p>
    </div>
  <?php endif; ?>
  <!-- MESSAGES TO SHOW -->
    <?php for ($i = 0; isset($app->getProperties('_rooms')->$i); $i++) : ?>
    <a href="./chat.php?r=<?= isset($app->getProperties('_rooms')->$i) ? h($app->getProperties('_rooms')->$i->id) : "" ?>">
      <div class="chat-list">
      <table class="chat-list__table">
        <tbody>
          <!-- 1行目 -->
          <tr>
            <?php if (isset($app->getProperties('_messages')->$i[0]->open_flg) && $app->getProperties('_messages')->$i[0]->open_flg == 0) : ?>
            <td class="label bg--skyblue" rowspan="2"></td>
            <?php endif; ?>
            <td class="user-icon" rowspan="2">
               <!-- user icon -->
              <div class="chat-list__user-icon-wrap">
                <img src="<?= isset($app->getProperties('_clients')->$i->profile_img) ? h($app->getProperties('_clients')->$i->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="chat-list__user-icon">
              </div>
            </td>

            <td class="user-name">
              <!-- user name -->
              <?php if (isset($app->getProperties('_clients')->$i->surname) && isset($app->getProperties('_clients')->$i->givenname)) : ?>
              <p class="user-name__text margin--0">
                <?= h($app->getProperties('_clients')->$i->surname); ?>
                <?= h($app->getProperties('_clients')->$i->givenname); ?>
              </p>
              <?php endif; ?>
          </td>

          <td class="time" rowspan="2">
            <time><?= isset($app->getProperties('_messages')->$i[0]->modified_date) ? date('m月d日 H:i', strtotime(h($app->getProperties('_messages')->$i[0]->modified_date))) : "" ?></time>
          </td>
          </tr>
          <!-- 2行目 -->
          <tr>
            <td class="chat-summary">
            <!-- chat -->
              <p class="chat-summary__text margin--0">
              <?= isset($app->getProperties('_messages')->$i[0]->msg) ? h($app->getProperties('_messages')->$i[0]->msg) : "メッセージはありません。"  ?>
              </p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    </a>
    <?php endfor; ?>
  </div>

</main>
</body>
</html>