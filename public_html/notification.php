
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\Notification();
  $app->run();
  $upload = new MyApp\Controller\UploadWork();
  $upload->run();
  $requestPage = 'notification -';
  $jsPath1 = './../js/notification.js';
  $jsPath2 = './../js/aside.js';
  $jsPath3 = './../js/uploadWork.js';
  $jsPath4 = '';
  $CSSPath1 = './../CSS/notification.css';
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

<!-- message -->
<?php if (!empty($_SESSION['messages']['notification'])) : ?>
  <div class="message">
    <p class="message__text"><?= h($app->getMessage($_SESSION['messages']['notification']))  ?></p>
  </div>
<?php endif; ?>

  
<main>
  <div class="notification-window">
  <?php require_once(__DIR__ . '/uploadWork.php'); ?>
  <!-- NOTHING TO SHOW -->
  <?php if (!isset($app->getProperties('_friends')->{0}) && !isset($app->getProperties('_messages')->{0})) : ?>
    <div class="no-show">
      <p>You've all caught up...</p>
    </div>
  <?php endif; ?>

  <!-- NOTIFICATION TO SHOW -->

  <!-- FRIENDS TO SHOW -->
  <?php if (isset($app->getProperties('_friends')->{0})) : ?>
    <ul>
    <?php for ($i = 0; isset($app->getProperties('_friends')->$i); $i++) : ?>
      <p class="friend-index">New Friend</p>
         <li>
           <div class="notification">
             <table class="notification__table">
                <tbody>
                  <!-- 1行目 -->
                  <tr>
                       <td class="user-icon" rowspan="2">
                  <!-- user icon -->
                           <a href="./profile.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">
                              <div class="notification__user-icon-wrap">
                                   <img class="notification__user-icon" src="<?= isset($app->getProperties('_friends')->$i->profile_img) ? h($app->getProperties('_friends')->$i->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像">
                               </div>
                             </a>
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
                <tr>
                   <td class="friend-summary">
                       <a href="./profile.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">
                <!-- friend profile -->
                          <p class="friend-summary__text margin--0">
                            <?= isset($app->getProperties('_friends')->$i->profile) ? mb_substr(h($app->getProperties('_friends')->$i->profile), 0, 50, "UTF-8") . "..." : "自己紹介文はありません。"  ?>
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
  <?php endif; ?>
  

   <!-- MESSAGES TO SHOW -->
   <?php if (isset($app->getProperties('_messages')->{0})) : ?>
    <ul>
      <?php for ($i = 0; isset($app->getProperties('_messages')->$i); $i++) : ?>
        <p class="message-index">New Message</p>
          <li>
             <div class="notification">
                <table class="notification__table">
                  <tbody>
                <!-- 1行目 -->
                     <tr>
                     <!-- user icon -->
                       <td class="user-icon" rowspan="2">
                         <a href="./chat.php?r=<?= isset($app->getProperties('_messages')->$i->room_id) ? h($app->getProperties('_messages')->$i->room_id) : "" ?>">
                           <div class="notification__user-icon-wrap">
                               <img src="<?= isset($app->getProperties('_messages')->$i->profile_img) ? h($app->getProperties('_messages')->$i->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="notification__user-icon">
                          </div>
                          </a>
                       </td>

                       <td class="user-name">
                    <!-- user name -->
                          <?php if (isset($app->getProperties('_messages')->$i->surname) && isset($app->getProperties('_messages')->$i->givenname)) : ?>
                            <a href="./chat.php?r=<?= isset($app->getProperties('_messages')->$i->room_id) ? h($app->getProperties('_messages')->$i->room_id) : "" ?>">
                              <p class="user-name__text margin--0">
                                  <?= h($app->getProperties('_messages')->$i->surname); ?>
                                  <?= h($app->getProperties('_messages')->$i->givenname); ?>
                              </p>
                            </a>
                          <?php endif; ?>
                       </td>

                       <td class="time" rowspan="2">
                          <time><?= isset($app->getProperties('_messages')->$i->modified_date) ? date('m月d日 H:i', strtotime(h($app->getProperties('_messages')->$i->modified_date))) : "" ?></time>
                       </td>
                   </tr>
               <!-- 2行目 -->
                   <tr>
                     <td class="chat-summary">
                     <!-- chat -->
                        <a href="./chat.php?r=<?= isset($app->getProperties('_messages')->$i->room_id) ? h($app->getProperties('_messages')->$i->room_id) : "" ?>">
                        <p class="chat-summary__text margin--0">
                           <?= isset($app->getProperties('_messages')->$i->msg) ? mb_substr(h($app->getProperties('_messages')->$i->msg), 0, 50, "UTF-8") : "メッセージはありません。"  ?>
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
  <?php endif; ?>
  </div>
</main>
</body>
</html>