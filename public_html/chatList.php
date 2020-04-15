
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\ChatList();
  $app->run();
  $notification = new MyApp\Controller\AccountField();
  $notification->run();
  $upload = new MyApp\Controller\UploadWork();
  $upload->run();
  $requestPage = 'CHAT LIST -';
  $jsPath1 = './../js/chatList.js';
  $jsPath2 = './../js/accountField.js';
  $jsPath3 = './../js/aside.js';
  $jsPath4 = './../js/uploadWork.js';
  $jsPath5 = '';
  $CSSPath1 = './../css/chatList.css';
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
?>


  
<main>
  <div class="chat-list-window">
  <?php require_once(__DIR__ . '/uploadWork.php'); ?>
  <!-- NOTHING TO SHOW -->
     <?php if (!isset($app->getProperties('_rooms')->{0}->id)) : ?>
        <div class="no-show">
          <p>Nothing to show...</p>
        </div>
     <?php endif; ?>
  <!-- MESSAGES TO SHOW -->
      <ul>
     <?php for ($i = 0; isset($app->getProperties('_rooms')->$i); $i++) : ?>
        <li>
         <div class="chat-list">
            <table class="chat-list__table">
                <tbody>
             <!-- 1行目 -->
                     <tr>
              <!-- label -->
                        <?php if (isset($app->getProperties('_messages')->$i[0]->open_flg) && $app->getProperties('_messages')->$i[0]->open_flg == 0) : ?>
                            <td class="label bg--skyblue" rowspan="2"></td>
                         <?php endif; ?>
               <!-- user icon -->
                            <td class="user-icon" rowspan="2">
                              <a href="./chat.php?r=<?= isset($app->getProperties('_rooms')->$i) ? h($app->getProperties('_rooms')->$i->id) : "" ?>">
                               <div class="chat-list__user-icon-wrap">
                                  <img src="<?= isset($app->getProperties('_clients')->$i->profile_img) ? h($app->getProperties('_clients')->$i->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="chat-list__user-icon">
                               </div>
                               </a>
                             </td>
                <!-- user name -->
                             <td class="user-name">
                               <?php if (isset($app->getProperties('_clients')->$i->surname) && isset($app->getProperties('_clients')->$i->givenname)) : ?>
                                <a href="./chat.php?r=<?= isset($app->getProperties('_rooms')->$i) ? h($app->getProperties('_rooms')->$i->id) : "" ?>">
                                  <p class="user-name__text margin--0">
                                     <?= h($app->getProperties('_clients')->$i->surname); ?>
                                     <?= h($app->getProperties('_clients')->$i->givenname); ?>
                                 </p>
                                 </a>
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
                           <a href="./chat.php?r=<?= isset($app->getProperties('_rooms')->$i) ? h($app->getProperties('_rooms')->$i->id) : "" ?>">
                             <p class="chat-summary__text margin--0">
                                <?= !empty($app->getProperties('_messages')->$i[0]->msg) ? substr_replace(mb_substr(h($app->getProperties('_messages')->$i[0]->msg), 0, 30, "UTF-8"), '...', -3) : "メッセージはありません。"  ?>
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
       <?php require_once('./footer.php'); ?>
  </div>

</main>
</body>
</html>