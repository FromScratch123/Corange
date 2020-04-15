
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\SearchFriend();
  $app->run();
  $notification = new MyApp\Controller\AccountField();
  $notification->run();
  $upload = new MyApp\Controller\UploadWork();
  $upload->run();
  $requestPage = 'SEARCH -';
  $jsPath1 = './../js/friendList.js';
  $jsPath2 = './../js/accountField.js';
  $jsPath3 = './../js/aside.js';
  $jsPath4 = './../js/uploadWork.js';
  $jsPath5 = '';
  $CSSPath1 = './../css/searchFriend.css';
  $CSSPath2 = './../css/accountField.css';
  $CSSPath3 = './../css/aside.css';
  $CSSPath4 = './../css/uploadWork.css';
  $CSSPath5 = '';
  
  require_once(__DIR__ . '/head.php');

  ?>

<body>
<?php 
$logoPath = './home.php';
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/accountField.php');
require_once(__DIR__ . '/aside.php');
require_once(__DIR__ . '/uploadWork.php');
 ?>

<!-- message -->
<?php if (!empty($_SESSION['messages']['search-friend'])) : ?>
  <div class="message">
      <p class="message__text"><?= !empty($app->getMessage('search-friend')) ? h($app->getMessage('search-friend')) : ""; ?></p>
  </div>
<?php endif; ?>

  
<main>
  <div class="search-friend-window">
  <!-- search window -->
  <form class="search-friend__search-window--wrap" action="" method="get">
    <input class="search-friend__search-window" type="text" name="search" placeholder="search by surname or givenname..."><i class="search-friend__search-window--icon fas fa-search"></i>
  </form>
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
      <div class="search-friend">
      <table class="search-friend__table">
        <tbody>
          <!-- 1行目 -->
          <tr>
            <td class="user-icon" rowspan="2">
               <!-- user icon -->
              <div class="search-friend__user-icon-wrap">
              <a href="./profile.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">
                <img src="<?= isset($app->getProperties('_friends')->$i->profile_img) ? h($app->getProperties('_friends')->$i->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="search-friend__user-icon">
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
              <li class="friend-menu-list">
              <a href="./profile.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">プロフィール</a>
              </li>
              <?php if ($app->getProperties('_friends')->$i->isFriend == false && $app->getProperties('_friends')->$i->isAsked == false ) : ?>
              <li class="friend-menu-list">
              <a href="./askBeFriend.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">友達申請を送る</a>
              </li>
              <?php endif; ?>
              <?php if ($app->getProperties('_friends')->$i->isFriend == true) : ?>
              <li class="friend-menu-list">
              <a href="./deleteFriend.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">友達解除</a>
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
              <?= !empty($app->getProperties('_friends')->$i->profile) ? substr_replace(mb_substr(h($app->getProperties('_friends')->$i->profile), 0, 50, "UTF-8"), '...', -3) : "自己紹介文はありません。"  ?>
              </p>
            </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <?php endfor; ?>
  </div>
  </li>
  </ul>
</main>
</body>
</html>