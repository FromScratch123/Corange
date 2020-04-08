<?php

require_once(__DIR__ . '/../config/config.php');
trackingStart();

$app = new MyApp\Controller\Profile();
$app->run();

//<head>
$requestPage = 'Profile -';
$jsPath1 = './../js/profile.js';
$jsPath2 = '';
$jsPath3 = '';
$jsPath4 = '';
$jsPath5 = '';
$CSSPath1 = './../css/profile.css';
$CSSPath2 = '';
$CSSPath3 = '';
$CSSPath4 = '';
$CSSPath5 = '';
require_once(__DIR__ . '/head.php');
//</head>

?>

<body>
<?php 
$logoPath = './home.php'; 
require_once(__DIR__ . '/header.php');
?>

<!-- 他のユーザーのプロフィール画面 -->
<?php if (!isset($app->getProperties('_users')->myself)) : ?>
<section class="profile">
<div class="banner">
  <img class="user-banner__img" src="<?= isset($app->getProperties('_friends')->banner_img) ? $app->getProperties('_friends')->banner_img : DEFAULT_USER_BANNER ?>" alt="ユーザーのバナー画像">
  <div class="icon-wrap flex-container">
    <!-- friend icon -->
    <p class="friend-icon margin--0">
    <a href="./askBeFriend.php?u=<?= isset($app->getProperties('_friends')->id) ? h($app->getProperties('_friends')->id) : "" ?>"><i class="icon--black fas fa-user-friends"></i></a>
    </p>
    <!-- chat icon -->
    <p class="chat-icon margin--0">
    <a href="./createRoom.php?u=<?= isset($app->getProperties('_friends')->id) ? h($app->getProperties('_friends')->id) : "" ?>"><i class="icon--black fas fa-comment-dots"></i></a>
    </p>
  </div>
</div>

  <table class="profile-table">
    <tbody>
      <!-- 1行目 -->
      <tr>
        <td class="user-icon" rowspan="2">
        <!-- user icon -->
        <div class="user-icon-wrap">
                <img class="user-icon__img" src="<?= isset($app->getProperties('_friends')->profile_img) ? h($app->getProperties('_friends')->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像">
        </div>
        </td>
        <td class="user-name">
          <?= isset($app->getProperties('_friends')->surname) && isset($app->getProperties('_friends')->givenname) ? h($app->getProperties('_friends')->surname) . " " . h($app->getProperties('_friends')->givenname) : "" ?>
        </td>
        <td class="user-age" rowspan="2">
        <?= isset($app->getProperties('_friends')->age) ? h($app->getProperties('_friends')->age) . " 歳" : "" ?>
        </td>
        <td class="user-prefecture" rowspan="2">
        <i class="fas fa-map-marker-alt"></i>
        <?= isset($app->getProperties('_friends')->prefecture) ? h($app->getProperties('_friends')->prefecture) : "" ?>
        </td>
      </tr>
      <!-- 2行目 -->
      <tr>
        <td class="user-slogan">
          <?= isset($app->getProperties('_friends')->slogan) ? h($app->getProperties('_friends')->slogan) : "" ?>
           </td>
      </tr>
    </tbody>
  </table>

    <div class="profile-summary">
      <p class="profile-summary__text"><?= isset($app->getProperties('_friends')->profile) ? h($app->getProperties('_friends')->profile) : "自己紹介文はありません" ?></p>
    </div>

    <?php for ($i = 0; isset($app->getProperties('_myWorks')->$i); $i++) : ?>
    <div class="work-display--flex flex-container">
      <div class="work-img-wrap">
        <img src="<?= isset($app->getProperties('_myWorks')->$i->thumbnail) ? h($app->getProperties('_myWorks')->$i->thumbnail) : "" ?>" alt="" class="work__img"> 
        <div class="work-img-cover">
          <p class="work-title"><?= isset($app->getProperties('_myWorks')->$i->title) ? h($app->getProperties('_myWorks')->$i->title) : "" ?></p>
        </div>
      </div>
    </div>
    <?php endfor; ?>

  </section>
<?php endif; ?>


<!-- 自身のプロフィール画面 -->
<?php if (isset($app->getProperties('_users')->myself) && $app->getProperties('_users')->myself == true) : ?>

<section class="profile">
<form class="profile-form" action="" method="post" enctype="multipart/form-data">
<div class="banner">
<input type="hidden" name="MAX_FILE_SIZE" value="<?= h(MAX_FILE_SIZE) ?>">
<input class ="user-banner__input" type="file" name="banner_img" >
  <img class="user-banner__img" src="<?= isset($app->getValues()->banner_img) ? $app->getValues()->banner_img : DEFAULT_USER_BANNER ?>" alt="ユーザーのバナー画像">
  <div class="user-banner__cover">
    <i class="user-icon__camera fas fa-camera"></i>
  </div>
  </div>
  <table class="profile-table">
    <tbody>
      <!-- 1行目 -->
        <tr>
        <td class="user-icon" rowspan="2">
        <!-- user icon -->
        <div class="user-icon-wrap">
         <input type="hidden" name="MAX_FILE_SIZE" value="<?= h(MAX_FILE_SIZE) ?>">
         <input class ="user-icon__input" type="file" name="profile_img" >
          <img class="user-icon__img" src="<?= isset($app->getValues()->profile_img) ? h($app->getValues()->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像">
         <div class="user-icon__cover">
          <i class="user-icon__camera fas fa-camera"></i>
          </div>
        </div>
        </td>
        <td class="user-name">
          <?= isset($app->getProperties('_users')->surname) && isset($app->getProperties('_users')->givenname) ? h($app->getProperties('_users')->surname) . " " . h($app->getProperties('_users')->givenname) : "" ?>
        </td>
        <td class="user-age" rowspan="2">
        <?= isset($app->getProperties('_users')->age) ? h($app->getProperties('_users')->age) . " 歳" : "" ?>
        </td>
        <td class="user-prefecture" rowspan="2">
        <i class="fas fa-map-marker-alt"></i>
        <?= isset($app->getProperties('_users')->prefecture) ? h($app->getProperties('_users')->prefecture) : "" ?>
        </td>
      </tr>
      <!-- 2行目 -->
      <tr>
        <td class="user-slogan">
        <p class="has-error margin--0"><?= $app->getErrors('slogan'); ?></p>
          <input class="user-slogan__input" type="text" name="slogan" placeholder="あなたのキャッチフレーズを入力しましょう。(50文字以内)" value="<?= isset($app->getValues()->slogan) ? h($app->getValues()->slogan) : "" ?>">
          <div class="slogan-limit-wrap">
            <span class="slogan-count js--hidden">0</span><span class="slogan-limit js--hidden">/50</span>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <p class="profile-error has-error margin--0"><?= $app->getErrors('common'); ?></p>
    <div class="profile-summary">
    <p class="has-error margin--0"><?= $app->getErrors('summary'); ?></p>
    <div class="profile-limit-wrap">
      <span class="profile-count js--hidden">0</span><span class="profile-limit js--hidden">/250</span>
    </div>
      <textarea name="profile" class="profile-textarea" placeholder="自己紹介文を入力しましょう。(250文字以内)"><?= isset($app->getValues()->profile) ? h($app->getValues()->profile) : "" ?></textarea>
    </div>
    <!-- token -->
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <p>
      <input class="profile-submit js--hidden" type="submit" value="Modify">
    </p>
    </form>

    <h1 class="work-dispaly__title">Works</h1>
    <div class="work-display--flex flex-container">
      <?php for ($i = 0; isset($app->getProperties('_myWorks')->$i); $i++) : ?>
      <div class="work-img-wrap">
        <img src="<?= isset($app->getProperties('_myWorks')->$i->thumbnail) ? h($app->getProperties('_myWorks')->$i->thumbnail) : "" ?>" alt="" class="work__img"> 
        <div class="work-img-cover">
          <p class="work-title margin--0"><?= isset($app->getProperties('_myWorks')->$i->title) ? h($app->getProperties('_myWorks')->$i->title) : "" ?></p>
        </div>
      </div>
      <?php endfor; ?>
    </div>

  </section>
<?php endif; ?>
  
</body>
</html>