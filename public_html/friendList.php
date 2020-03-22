
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\FriendList();
  $app->run();
  $requestPage = 'FRIEND LIST -';
  $jsPath = './../js/friendList.js';
  $CSSPath1 = './../CSS/friendList.css';
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

<!-- message -->
<?php if (!empty($_SESSION['messages']['friend-list'])) : ?>
  <div class="message">
    <p class="message__text"><?= h($app->getMessage($_SESSION['messages']['friend-list']))  ?></p>
  </div>
<?php endif; ?>

  
<main>
  <div class="friend-list-window">
  <!-- NOTHING TO SHOW -->
  <?php if (!isset($app->getProperties('_friends')->{0})) : ?>
    <div class="no-show">
      <p>Nothing to show...</p>
    </div>
  <?php endif; ?>
  <!-- FRIENDS TO SHOW -->
    <?php for ($i = 0; isset($app->getProperties('_friends')->$i); $i++) : ?>
    
    <ul>
      <li>
      <div class="friend-list">
      <table class="friend-list__table">
        <tbody>
          <!-- 1行目 -->
          <tr>
            <?php if (isset($app->getProperties('_friends')->$i) && $app->getProperties('_friends')->$i->accept_flg == 0) : ?>
            <td class="label bg--green" rowspan="2"></td>
            <?php endif; ?>
            <td class="user-icon" rowspan="2">
               <!-- user icon -->
              <div class="friend-list__user-icon-wrap">
              <a href="./profile.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">
                <img src="<?= isset($app->getProperties('_friends')->$i->profile_img) ? h($app->getProperties('_friends')->$i->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="friend-list__user-icon">
            </a>
              </div>
            </td>

            <td class="user-name">
            <a href="./profile.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">
              <!-- user name -->
              <?php if (isset($app->getProperties('_friends')->$i->surname) && isset($app->getProperties('_friends')->$i->givenname)) : ?>
              <p class="user-name__text margin--0">
                <?= h($app->getProperties('_friends')->$i->surname); ?>
                <?= h($app->getProperties('_friends')->$i->givenname); ?>
              </p>
              <?php endif; ?>
            </a>
          </td>
       <!-- friend menu -->
       <td class="friend-menu" rowspan="2">
          <i id="friend-menu-trigger" class="friend-menu-trigger menu fas fa-ellipsis-h">
          <div class="friend-menu-box js--hidden">
            <ul>
            <?php if (isset($app->getProperties('_friends')->$i) && $app->getProperties('_friends')->$i->accept_flg == 1) : ?>
              <li class="friend-menu-list">
                <a href="./chat.php">メッセージ</a>
              </li>
              <li class="friend-menu-list">
              <a class="friend-menu-list__delete" href="./deleteFriend.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">友達解除</a>
              </li>
            <?php endif; ?>
            <?php if (isset($app->getProperties('_friends')->$i) && $app->getProperties('_friends')->$i->accept_flg == 0) : ?>
              <li class="friend-menu-list">
              <a class="friend-menu-list__delete" href="./acceptFriend.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">友達申請承諾</a>
              </li>
            <?php endif; ?>
            <li class="friend-menu-list">
                <a href="">ヘルプ</a>
              </li>
            </ul>
           </div> 
           </i>
          </td>

          </tr>
          <!-- 2行目 -->
          <tr>
            <td class="friend-summary">
            <a href="./profile.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">
            <!-- friend profile -->
              <p class="friend-summary__text margin--0">
              <?= isset($app->getProperties('_friends')->$i->profile) ? h($app->getProperties('/friends')->$i->profile) : "自己紹介文はありません。"  ?>
              </p>
            </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    </a>
    <?php endfor; ?>
  </div>
  </li>
  </ul>
</main>
</body>
</html>