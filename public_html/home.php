
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\Home();
  $app->run();
  $upload = new MyApp\Controller\UploadWork();
  $upload->run();

  $requestPage = 'HOME -';
  $jsPath1 = './../js/home.js';
  $jsPath2 = './../js/aside.js';
  $jsPath3 = './../js/uploadWork.js';
  $jsPath4 = '';
  $CSSPath1 = './../CSS/home.css';
  $CSSPath2 = './../CSS/accountField.css';
  $CSSPath3 = './../CSS/aside.css';
  $CSSPath4 = './../CSS/uploadWork.css';

  
  require_once(__DIR__ . '/head.php');

  ?>

<body>
<?php 
$logoPath = '';
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/accountField.php');
require_once(__DIR__ . '/aside.php');
 ?>

<!-- message -->
<?php if (!empty($_SESSION['messages'])) : ?>
  <div class="message">
    <p class="message__text"><?= h($app->getMessage($_SESSION['messages']))  ?></p>
  </div>
<?php endif; ?>
  
<main>
  <div class="project-window">
  <?php require_once(__DIR__ . '/uploadWork.php'); ?>
    <div class="project-window__overroll--flex flex-container">
      <?php for ($i = 0; isset($app->getProperties('_myWorks')->$i); $i++) : ?>
      <div class="project">
        <div class="work-img-wrap">
          <img class="work__img" src="<?= isset($app->getProperties('_myWorks')->$i->thumbnail) ? h($app->getProperties('_myWorks')->$i->thumbnail) : '' ?>" alt="">
        </div>
        <p class="margin--0"><?= isset($app->getProperties('_myWorks')->$i) ? mb_substr(h($app->getProperties('_myWorks')->$i->title), 0, 10, "UTF-8") . "..." : ""; ?></p>
        <p class="margin--0"><?= isset($app->getProperties('_myWorks')->$i->modified_date) ? date('m月d日 H:i', strtotime(h($app->getProperties('_myWorks')->$i->modified_date))) : "" ?></p>
      </div>
      <?php endfor; ?>
    </div>

    <div id="tool-bar" class="tool-bar--flex-container flex-container">
      <div class="tool-bar__breadcrumbs">
        <span>Home >> My Project >> 最近使用したファイル</span>
      </div>
      <div class="tool-bar__sort">
        <ul class="tool-bar__sort-flex-container flex-container">
          <li class="sort-icon"><i class="fas fa-sort-alpha-down"></i></li>
          <li class="sort-icon"><i class="fas fa-sort-alpha-up"></i></li>
          <li class="sort-icon"><i class="far fa-clock"></i></li>
        </ul>
      </div>
    </div>

    <div class="project-window__details">
      <table class="project-window__table">
        <tbody>
             <?php for ($i = 0; isset($app->getProperties('_friendWorks')->$i); $i++) : ?>
             <!-- user icon -->
                <td class="friend-icon" rowspan="2">
                  <a href="./profile.php?u=<?= isset($app->getProperties('_friendWorks')->$i[$i]) ? h($app->getProperties('_friendWorks')->$i[$i]->id) : "" ?>">
                      <div class="friend-work__user-icon-wrap">
                          <img class="friend-work__user-icon" src="<?= isset($app->getProperties  ('_friendWorks')->$i[$i]->profile_img) ? h($app->getProperties('_friendWorks')->$i[$i]->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像">
                    </div>
                    </a>
                </td>
              <!-- work img -->
                <td class="work-img">
                  <a href="">
                    <div class="friend-work__work-img-wrap">
                      <img src="<?= isset($app->getProperties('_friendWorks')->$i->work) ? h($app->getProperties('_friendWorks')->$i->work) : ''; ?>" alt="" class="friend-work__work-img">
                    </div>
                  </a>
                </td>
              <!-- work title -->
                <td class="work-title">
                  <a href="">
                      <p class="work-title__text margin--0">
                        <?= isset($app->getProperties('_friendWorks')->$i->title) ? h($app->getProperties('_friendWorks')->$i->title) : '' ?>
                      </p>
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
              <!-- work description -->
                <tr>
                  <td class="work-description">
                      <a href="">
                          <p class="work-description__text margin--0">
                            <?= isset($app->getProperties('_friendWorks')->$i->description) ? mb_substr(h($app->getProperties('_friendWorks')->$i->description), 0, 50, "UTF-8") . "..." : "説明文はありません"  ?>
                          </p>
                        </a>
                  </td>
                </tr>
          <?php endfor; ?>
           
        </tbody>
      </table>
      <footer class="footer">
        
      </footer>
    </div>
  </div>

</main>
</body>
</html>