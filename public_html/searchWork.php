
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\SearchWork();
  $app->run();
  $notification = new MyApp\Controller\accountField();
  $notification->run();
  $upload = new MyApp\Controller\UploadWork();
  $upload->run();
  $requestPage = 'SEARCH -';
  $jsPath1 = './../js/home.js';
  $jsPath2 = './../js/accountField.js';
  $jsPath3 = './../js/aside.js';
  $jsPath4 = './../js/uploadWork.js';
  $jsPath5 = '';
  $CSSPath1 = './../CSS/home.css';
  $CSSPath2 = './../CSS/accountField.css';
  $CSSPath3 = './../CSS/aside.css';
  $CSSPath4 = './../CSS/uploadWork.css';
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

<!-- message -->
<?php if (!empty($_SESSION['messages']['search-work'])) : ?>
  <div class="message">
      <p class="message__text"><?= !empty($app->getMessage('search-work')) ? h($app->getMessage('search-work')) : ""; ?></p>
  </div>
<?php endif; ?>

<main>
  <div class="work-window">
  <?php require_once(__DIR__ . '/uploadWork.php'); ?>


<!-- TOOL BAR -->
<div id="tool-bar" class="tool-bar--flex flex-container">
      <div class="breadcrumbs">
        <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumbs--flex flex-container">

        <?php if (strpos($_SERVER['REQUEST_URI'], '?my=', 0) !== false) : ?>
        <?php require_once('./breadcrumbs/bcMyWork.php'); ?>
        <?php endif; ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], '?all=', 0) !== false) : ?>
        <?php require_once('./breadcrumbs/bcAllWork.php'); ?>
        <?php endif; ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], '?favorite=', 0) !== false) : ?>
        <?php require_once('./breadcrumbs/bcFavorite.php'); ?>
        <?php endif; ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], '?trash=', 0) !== false) : ?>
        <?php require_once('./breadcrumbs/bctrash.php'); ?>
        <?php endif; ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], '?category=', 0) !== false) : ?>
        <?php require_once('./breadcrumbs/bcSearch.php'); ?>
        <?php endif; ?>
        </ol>
      </div>

      <?php if (strpos($_SERVER['REQUEST_URI'], '?my=', 0) !== false) : ?>
        <?php require_once('./sort/myWork.php'); ?>
        <?php endif; ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], '?all=', 0) !== false) : ?>
        <?php require_once('./sort/allWork.php'); ?>
        <?php endif; ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], '?favorite=', 0) !== false) : ?>
        <?php require_once('./sort/favorite.php'); ?>
        <?php endif; ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], '?trash=', 0) !== false) : ?>
        <?php require_once('./sort/trash.php'); ?>
        <?php endif; ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], '?category=', 0) !== false) : ?>
        <?php require_once('./sort/search.php'); ?>
        <?php endif; ?>
        
    </div>
    

    <!-- NOTHING TO SHOW -->
    <?php if (!isset($app->getProperties('_othersWorks')->{0})) : ?>
       <div class="no-show">
           <p>Nothing to show...</p>
       </div>
    <?php endif; ?>
    
    <div class="others-work-area">
      <?php for ($i = 0; isset($app->getProperties('_othersWorks')->$i); $i++) : ?>
      <div class="others-work--flex flex-container">
        <!-- work img -->
        <div class="work-img-wrap">
          <a href="./workDetails.php?w=<?= isset($app->getProperties('_othersWorks')->$i->work_id) ? h($app->getProperties('_othersWorks')->$i->work_id) : "" ?>">
            <img src="<?= isset($app->getProperties('_othersWorks')->$i->work) ? h($app->getProperties('_othersWorks')->$i->work) : ''; ?>" alt="" class="work__img">
          </a>
        </div>

        <div class="work-info-wrap">
          <!-- work title -->
          <div class="work-title">
                <p class="work-title__text margin--0">
                 <a href="./workDetails.php?w=<?= isset($app->getProperties('_othersWorks')->$i->work_id) ? h($app->getProperties('_othersWorks')->$i->work_id) : "" ?>">
                  <?= isset($app->getProperties('_othersWorks')->$i->title) ? h($app->getProperties('_othersWorks')->$i->title) : '' ?>
                 </a>
                </p>
          </div>
           <!-- work description -->
           <div class="work-description">
              <p class="work-description__text margin--0">
                 <a href="./workDetails.php?w=<?= isset($app->getProperties('_othersWorks')->$i->work_id) ? h($app->getProperties('_othersWorks')->$i->work_id) : "" ?>">
                    <?= !empty($app->getProperties('_othersWorks')->$i->description) ? substr_replace(mb_substr(h($app->getProperties('_othersWorks')->$i->description), 0, 30, "UTF-8"), '...', -3) : "説明文はありません"  ?>
                 </a>
              </p>
           </div>
           <?php if (isset($app->getProperties('_othersWorks')->$i->delete_flg) && $app->getProperties('_othersWorks')->$i->delete_flg == 0) : ?>
           <!-- others icon -->
           <div class="others-info-wrap--flex flex-container">
             <div class="others-icon-wrap">
              <a href="./profile.php?u=<?= isset($app->getProperties('_othersWorks')->$i) ? h($app->getProperties('_othersWorks')->$i->id) : "" ?>">
                  <img class="others-icon__img" src="<?= isset($app->getProperties  ('_othersWorks')->$i->profile_img) ? h($app->getProperties('_othersWorks')->$i->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像">
                  </a>
               </div>
  
           <!-- ohters name -->
              <div class="others-name">
                <p class="others-name__text">
                  <a href="./profile.php?u=<?= isset($app->getProperties('_othersWorks')->$i) ? h($app->getProperties('_othersWorks')->$i->id) : "" ?>">
                    <?= $app->getProperties('_othersWorks')->$i->surname && $app->getProperties('_othersWorks')->$i->givenname ? h($app->getProperties('_othersWorks')->$i->surname) . " " . h($app->getProperties('_othersWorks')->$i->givenname) : "" ?>
                  </a>
                </p>
              </div>
           </div>
           <?php endif; ?>
         </div>

         <!-- thumbs up -->
         <i class="thumbs-up fas fa-thumbs-up <?= isset($app->getProperties('_othersWorks')->$i->isFavorite) && $app->getProperties('_othersWorks')->$i->isFavorite > 0 ? 'thumbs-up--true' : "" ?>" data-work-id="<?= isset($app->getProperties('_othersWorks')->$i) ? h($app->getProperties('_othersWorks')->$i->work_id) : "" ?>" data-create-user="<?= isset($app->getProperties('_othersWorks')->$i->create_user) ? h($app->getProperties('_othersWorks')->$i->create_user) : "" ?>"></i>
          <span class="good-count"><?= isset($app->getProperties('_othersWorks')->$i->favoriteNum) ? h($app->getProperties('_othersWorks')->$i->favoriteNum) : "" ?></span>

        <div class="time">
          <p class="time__text margin--0">
             <?= isset($app->getProperties('_othersWorks')->$i->create_date) ? date('m月d日 H:i', strtotime(h($app->getProperties('_othersWorks')->$i->create_date))) : "" ?>
          </p>
        </div>
        



        <!-- others menu -->
        <div class="others-menu">
            <i id="others-menu-trigger" class="others-menu-trigger fas fa-ellipsis-h">
              <div class="others-menu-box js--hidden">
                  <ul>
                    <li class="others-menu-list">
                     <a href="./profile.php?u=<?= isset($app->getProperties('_othersWorks')->$i) ? h($app->getProperties('_othersWorks')->$i->id) : "" ?>">プロフィール</a>
                    </li>
                    <?php if (isset($app->getProperties('_friends')->$i) && $app->getProperties('_friends')->$i->accept_flg == false && $app->getProperties('_friends')->$i->follow_user !== $_SESSION['me']->id) : ?>
                    <li class="others-menu-list">
                        <a href="./acceptFriend.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">友達申請承諾</a>
                    </li>
                    <li class="others-menu-list">
                        <a href="./deleteFriend.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">友達申請拒否</a>
                      </li>
                      <?php endif; ?>
                      <li class="others-menu-list">
                        <a href="./workDetails.php?w=<?= isset($app->getProperties('_othersWorks')->$i->work_id) ? h($app->getProperties('_othersWorks')->$i->work_id) : "" ?>" class="work__link" data-work-id="<?= isset($app->getProperties('_othersWorks')->$i->work_id) ? h($app->getProperties('_othersWorks')->$i->work_id) : ""; ?>">
                        作品詳細
                        </a>
                      </li>
                      <li class="others-menu-list">
                        <a href="">ヘルプ</a>
                      </li>
                  </ul>
                </div> 
              </i>
        </div>
      </div>
      <?php endfor; ?>
      <footer class="footer">
        
      </footer>
    </div>
  </div>

</main>
</body>
</html>