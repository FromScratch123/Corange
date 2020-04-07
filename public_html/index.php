<?php

require_once(__DIR__ . '/../config/config.php');
//log header
trackingStart();
//Signup Controller読込
$app = new MyApp\Controller\Signup();
//ログイン状態の確認
$app->run();

//HTML 
//head読込
$requestPage = '';
$jsPath1 = '';
$jsPath2 = '';
$jsPath3 = '';
$jsPath4 = '';
$jsPath5 = '';
$CSSPath1 = '';
$CSSPath2 = '';
$CSSPath3 = '';
$CSSPath4 = '';
$CSSPath5 = '';
require_once(__DIR__ . '/head.php');

?>

<body>
<!-- hero -->
  <div class="hero">
    <!-- header -->
    <?php 
    $logoPath = ''; 
    require_once(__DIR__ . '/header.php'); 
    ?>
    <!-- text -->
      <p class="hero__text">Be Connected.<br>Be creative.</p>
    <!-- btn -->
    <button class="hero__signup-btn"><a href="signup.php">Sign Up Now!</a></button>
    <button class="hero__about-btn">About Corange</button>

<!-- signup drawer -->    
    <div class="signup-drawer">
      <button class="signup-drawer__times">
        <i class="fas fa-times"></i>
      </button>
      <div class="sigup-drawer__content-wrap">
        <p class="signup-drawer__title">Sign Up</p>
        <p class="signup-drawer__to-login fz--small">or <a class="color--blue" href="./login.php">Log In</a> your account</p>
        <p class="has-error margin--0"><?= $app->getErrors('common'); ?></p>
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
          </label>
          <!-- password -->
          <label for="password">
            <p class="has-error margin--0"><?= $app->getErrors('password'); ?></p>
            <span class="color--red">※</span>
            <p class="margin--0">
              <input type="password" name="password" placeholder="password"> 
            </p>
          </label>
          <!-- agree -->
          <label class="agree-label">
             <p class="has-error margin--0"><?= $app->getErrors('agree'); ?></p>
            <p class="fz--small">
              <input class="agree" type="checkbox" name="agree">
              I agree to <span class="color--blue"><a href=""> Corange terms</a></span>
            </p>
          </label>
          <!-- token -->
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
          <p class="margin--0">
            <input class="signup-drawer__submit" type="submit" value="Sign Up">
          </p>
        </form>
      </div>
    </div>
  </div>

  
</body>
</html>