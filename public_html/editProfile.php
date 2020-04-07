<?php 

  require_once(__DIR__ . '/../config/config.php');
  trackingStart();
  $app = new MyApp\Controller\EditProfile();
  $app->run();
  $notification = new MyApp\Controller\accountField();
  $notification->run();

  $requestPage = 'PROFILE -';
  $jsPath1 = './../js/editProfile.js';
  $jsPath2 = '';
  $jsPath3 = '';
  $jsPath4 = '';
  $jsPath5 = '';
  $CSSPath1 = './../CSS/editProfile.css';
  $CSSPath2 = './../css/accountField.css';
  $CSSPath3 = '';
  $CSSPath4 = '';
  $CSSPath5 = '';
  require_once(__DIR__ . '/head.php');

  ?>

  <body>
  <?php 
  $logoPath = './home.php'; 
  require_once(__DIR__ . '/header.php');
  require_once(__DIR__ . '/accountField.php');
  ?>
  <section class="edit-profile">
    <div class="edit-profile__content-wrap">
      <p class="edit-profile__title">Modify profile</p>
      <p class="fz--small edit-profile__link">
      <a href="./profile.php?u=<?= $_SESSION['me']->id; ?>">プロフィール画面を確認</a>
      </p>
      <form class="flex-container edit-profile-flex-container" action="" method="post" enctype="multipart/form-data">
        <div class="user-icon-wrap">
        <p class="has-error margin--0"><?= $app->getErrors('user-icon'); ?></p>
          <!-- user icon -->
          <div class="user-icon">
            <input type="hidden" name="MAX_FILE_SIZE" value="<?= h(MAX_FILE_SIZE) ?>">
            <input class ="user-icon__input" type="file" name="user-icon" >
            <img class="user-icon__img" src="<?= isset($app->getProperties('_users')->profile_img) ? h($app->getProperties('_users')->profile_img) : './../images/default_user_icon.png'; ?>" alt="">
            <div class="user-icon__cover">
            <i class="user-icon__camera fas fa-camera"></i>
            </div>
          </div>
        </div>
        <div class="user-info-wrap">
          <p class="has-error margin--0"><?= $app->getErrors('empty'); ?></p>
          <!-- surname -->
          <label for="surname">
              <p class="has-error margin--0"><?= $app->getErrors('surname'); ?></p>
          <span class="fz--small">
          姓: 
          </span>
           <span class="color--red">※</span>
            <p class="margin--0">
              <input type="text" name="surname" value="<?= isset($app->getValues()->surname) ? h($app->getValues()->surname) : ''; ?>" placeholder="surname">
            </p>
          </label>
          <!-- givenname -->
          <label for="givenname">
          <span class="fz--small">
          名: 
          </span>
          <span class="color--red">※</span>
            <p class="margin--0">
              <input type="text" name="givenname" value="<?= isset($app->getValues()->givenname) ? h($app->getValues()->givenname) : ''; ?>" placeholder="givenname"> 
            </p>
          </label>
          <!-- age -->
          <label>
            
            <p class="has-error margin--0"><?= $app->getErrors('age'); ?></p>
            <p class="margin--0">
            <span class="fz--small">
            年齢:
            </span>
            <input type="text" name="age" value="<?= isset($app->getValues()->age) ? h($app->getValues()->age) : ''; ?>" placeholder="age">
            </p>
          </label>
          <!-- tel -->
          <label>
            <p class="has-error margin--0"><?= $app->getErrors('tel'); ?></p>
            <p class="margin--0">
            <span class="fz--small">
            電話番号:
            </span>
            <input type="text" name="tel" value="<?= isset($app->getValues()->tel) ? h($app->getValues()->tel) : ''; ?>" placeholder="00-0000-0000">
            </p>
          </label>
          <!-- email -->
          <label for="email">
            <p class="has-error margin--0"><?= $app->getErrors('email'); ?></p>
            <span class="fz--small">
            Email:
            </span>
            <span class="color--red">※</span>
            <p class="margin--0">
              <input type="text" name="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>"
              placeholder="email"> 
            </p>
          </label>
          <!-- zip -->
          <label>
            <p class="has-error margin--0"><?= $app->getErrors('zip'); ?></p>
            <p class="margin--0">
            <span class="fz--small">
            郵便番号:
            </span>
            <input type="text" name="zip" value="<?= isset($app->getValues()->zip) ? h($app->getValues()->zip) : ''; ?>" placeholder="000-0000" onKeyUp="AjaxZip3.zip2addr(this,'','prefecture','municipalities');">
            </p>
          </label>
          <!-- 都道府県 -->
          <label>
            <p class="has-error margin--0"><?= $app->getErrors('prefecture'); ?></p>
            <p class="margin--0">
            <span class="fz--small">
            住所:
            </span>
            <input type="text" name="prefecture" value="<?= isset($app->getValues()->prefecture) ? h($app->getValues()->prefecture) : ''; ?>" placeholder="都道府県">
            </p>
          </label>
          <!-- 市町村 -->
          <label>
            <p class="has-error margin--0"><?= $app->getErrors('municipalities'); ?></p>
            <p class="margin--0">
            <input type="text" name="municipalities" value="<?= isset($app->getValues()->municipalities) ? h($app->getValues()->municipalities) : ''; ?>" placeholder="市町村">
            </p>
          </label>
          <!-- 番地 -->
          <label>
            <p class="has-error margin--0"><?= $app->getErrors('address'); ?></p>
            <p class="margin--0">
            <input type="text" name="address" value="<?= isset($app->getValues()->address) ? h($app->getValues()->address) : ''; ?>" placeholder="番地">
            </p>
          </label>
          <!-- token -->
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
          <p>
            <input class="edit-profile__submit" type="submit" value="Modify">
          </p>
        </div>
      </form>
      </div>
    </section>
  </body>
  </html>
