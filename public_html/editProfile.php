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
  <form action="" method="post">
          <!-- surname -->
          <label for="surname">
             <p class="has-error margin--0"><?= $app->getErrors('surname'); ?></p>
             <span class="color--red">※</span>
            <p class="margin--0">
              <input type="text" name="surname" value="<?= isset($app->getValues()->surname) ? h($app->getValues()->surname) : ''; ?>" placeholder="surname">
            </p>
            
          </label>
          <!-- givenname -->
          <label for="givenname">
            <span class="color--red">※</span>
            <p class="margin--0">
              <input type="text" name="givenname" value="<?= isset($app->getValues()->givenname) ? h($app->getValues()->givenname) : ''; ?>" placeholder="givenname"> 
            </p>
          </label>
          <!-- email -->
          <label for="email">
            <p class="has-error margin--0"><?= $app->getErrors('email'); ?></p>
            <span class="color--red">※</span>
            <p class="margin--0">
              <input type="text" name="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>"
              placeholder="email"> 
            </p>
            <!-- age -->
            <input type="text" name="age" value="<?= isset($app->getValues()->age) ? h($app->getValues()->age) : ''; ?>" placeholder="age">
          </label>
          <!-- password -->
          <label for="password">
            <p class="has-error margin--0"><?= $app->getErrors('password'); ?></p>
            <span class="color--red">※</span>
            <p class="margin--0">
              <input type="password" name="password" placeholder="password"> 
            </p>
          </label> 
          <!-- token -->
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
          <p class="margin--0">
            <input class="signup-drawer__submit" type="submit" value="Sign Up">
          </p>
        </form>
  </body>
  </html>
