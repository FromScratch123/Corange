<?php

require_once(__DIR__ . '/../config/config.php');
trackingStart();

$app = new MyApp\Controller\Profile();
$app->run();

//<head>
$requestPage = 'Profile -';
$jsPath = './../js/profile.js';
$CSSPath1 = './../css/profile.css';
$CSSPath2 = '';
$CSSPath3 = '';
require_once(__DIR__ . '/head.php');
//</head>

?>

<body>
<?php 
$logoPath = './home.php'; 
require_once(__DIR__ . '/header.php');
?>
<section class="profile">


<div class="profile__banner">
  <img class="profile__banner-img" src="<?= isset($app->getProperties('_friends')->banner_img) ? $app->getProperties('_friends')->banner_img : DEFAULT_USER_BANNER ?>" alt="ユーザーのバナー画像">
  </div>

  <table class="profile-table">
    <tbody>
      <!-- 1行目 -->
      <tr>
        <td class="user-icon" rowspan="2">
        <!-- user icon -->
        <div class="profile__user-icon-wrap">
              <a href="./profile.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">
                <img class="profile__user-icon" src="<?= isset($app->getProperties('_friends')->profile_img) ? h($app->getProperties('_friends')->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像">
            </a>
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
  </section>
</body>
</html>