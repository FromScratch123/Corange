<?php 

  require_once(__DIR__ . '/../config/config.php');
  trackingStart();
  $app = new MyApp\Controller\EditProfile();
  $app->run();

  $requestPage = 'EDIT PROFILE -';
  $jsPath = './../js/editProfile.js';
  $CSSPath1 = './../CSS/editProfile.css';
  $CSSPath2 = './../css/accountField.css';
  $CSSPath3 = '';
  require_once(__DIR__ . '/head.php');

  ?>

  <body>
  <?php 
  $logoPath = './index.php'; 
  require_once(__DIR__ . '/header.php');
  require_once(__DIR__ . '/accountField.php');
  ?>
  <section class="edit-profile">
    <div class="edit-profile__content-wrap">
      <form action="" method="post">
      <p class="edit-profile__title">Modify profile</p>
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
      </form>
      </div>
    </section>
  </body>
  </html>
