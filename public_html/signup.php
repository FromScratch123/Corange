<?php

require_once(__DIR__ . '/../config/config.php');
//log header
trackingStart();
//Login Controller読込
$app = new MyApp\Controller\Signup();
//ログイン状態の確認
$app->run();

//HTML 
//head読込
$requestPage = 'Sign Up -';
$jsPath = './../js/signup.js';
$CSSPath1 = './../css/signup.css';
$CSSPath2 = '';
$CSSPath3 = '';
require_once(__DIR__ . '/head.php');

?>

<body>
<?php 
$logoPath = './index.php'; 
require_once(__DIR__ . '/header.php'); 
?>
<!-- signup -->    
<section id="signup" class="signup">
      <div class="signup__content-wrap">
        <p class="signup__title">Sign Up</p>
        <p class="signup__to-login fz--small">or <a class="color--blue" href="./login.php">Log in</a> your account</p>
        <p class="has-error margin--0"><?= $app->getErrors('empty'); ?></p>
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
        <p class="has-error margin--0"><?= $app->getErrors('givenname'); ?></p>
        <span class="color--red">※</span>
          <p class="margin--0">
            <input type="text" name="givenname" value="<?= isset($app->getValues()->givenname) ? h($app->getValues()->givenname) : ''; ?>"  placeholder="givenname"> 
          </p>
        </label>
        <!-- email -->
        <label for="email">
          <span class="color--red">※</span>
          <p class="has-error margin--0"><?= $app->getErrors('email'); ?></p>
          <p class="margin--0">
            <input type="text" name="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>" placeholder="email"> 
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
            I agree to <span class="color--blue"><a href=""> Duplazy terms</a></span>
          </p>
        </label>
        <!-- token -->
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        <p>
          <input class="signup__submit" type="submit" value="Sign Up">
        </p>
      </form>
    </div>
  </section>
</body>
</html>