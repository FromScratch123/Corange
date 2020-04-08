
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\FriendList();
  $app->run();
  $notification = new MyApp\Controller\accountField();
  $notification->run();
  $upload = new MyApp\Controller\UploadWork();
  $upload->run();
  $requestPage = 'FRIEND LIST -';
  $jsPath1 = './../js/friendList.js';
  $jsPath2 = './../js/accountField.js';
  $jsPath3 = './../js/aside.js';
  $jsPath4 = './../js/uploadWork.js';
  $jsPath5 = '';
  $CSSPath1 = './../CSS/friendList.css';
  $CSSPath2 = './../CSS/accountField.css';
  $CSSPath3 = './../CSS/aside.css';
  $CSSPath4 = './../CSS/uploadWork.css';
  $CSSPath4 = '';
  
  require_once(__DIR__ . '/head.php');

  ?>

<body>
<?php 
$logoPath = './home.php';
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/accountField.php');
require_once(__DIR__ . '/aside.php');
?>

<!-- message -->
<?php if (!empty($_SESSION['messages']['friend-list'])) : ?>
  <div class="message">
      <p class="message__text"><?= !empty($app->getMessage('friend-list')) ? h($app->getMessage('friend-list')) : ""; ?></p>
  </div>
<?php endif; ?>

  
<main>
  <div class="friend-list-window">
  <?php require_once(__DIR__ . '/uploadWork.php'); ?>
  <!-- search window -->
      <form class="search-friend__search-window--wrap" action="./searchFriend.php" method="get">
          <input class="search-friend__search-window" type="text" name="search" placeholder="search users..."><i class="search-friend__search-window--icon fas fa-search"></i>
      </form>
  <!-- NOTHING TO SHOW -->
    <?php if (!isset($app->getProperties('_friends')->{0})) : ?>
       <div class="no-show">
           <p>Nothing to show...</p>
       </div>
    <?php endif; ?>
  <!-- FRIENDS TO SHOW -->
    <ul>
    <?php for ($i = 0; isset($app->getProperties('_friends')->$i); $i++) : ?>
         <li>
           <div class="friend-list">
             <table class="friend-list__table">
               <tbody>
           <!-- 1行目 -->
                  <tr>
                     <?php if (isset($app->getProperties('_friends')->$i) && $app->getProperties('_friends')->$i->accept_flg == 0) : ?>
                       <td class="label bg--green" rowspan="2"></td>
                     <?php endif; ?>
                     <!-- user icon -->
                       <td class="user-icon" rowspan="2">
                          <a href="./profile.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">
                             <div class="friend-list__user-icon-wrap">
                                 <img class="friend-list__user-icon" src="<?= isset($app->getProperties  ('_friends')->$i->profile_img) ? h($app->getProperties('_friends')->$i->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像">
                            </div>
                           </a>
                        </td>

                      <!-- user name -->
                        <td class="user-name">
                          <a href="./profile.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">
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
                                         <a href="./createRoom.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">メッセージ</a>
                                      </li>
                                      <li class="friend-menu-list">
                                        <a href="./deleteFriend.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">友達解除</a>
                                      </li>
                                      <?php endif; ?>
                                      <?php if (isset($app->getProperties('_friends')->$i) && $app->getProperties('_friends')->$i->accept_flg == false && $app->getProperties('_friends')->$i->follow_user !== $_SESSION['me']->id) : ?>
                                      <li class="friend-menu-list">
                                         <a href="./acceptFriend.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">友達申請承諾</a>
                                      </li>
                                      <li class="friend-menu-list">
                                         <a href="./deleteFriend.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">友達申請拒否</a>
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
                      <!-- friend profile -->
                        <tr>
                          <td class="friend-summary">
                              <a href="./profile.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">
                                 <p class="friend-summary__text margin--0">
                                    <?= !empty($app->getProperties('_friends')->$i->profile) ? substr_replace(mb_substr(h($app->getProperties('_friends')->$i->profile), 0, 50, "UTF-8"), '...', -3)  : "自己紹介文はありません。"  ?>
                                 </p>
                               </a>
                          </td>
                        </tr>
                   </tbody>
               </table>
            </div>
          </li>
    <?php endfor; ?>
    </ul>
  </div>
</main>
</body>
</html>