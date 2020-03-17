<?php

require_once(__DIR__ . '/../config/config.php');
//log header
trackingStart();
//Login Controller読込
$app = new MyApp\Controller\Login();
//ログイン状態の確認
$app->run();

//HTML 
//head読込
$requestPage = 'LOG IN -';
$jsPath = './../js/login.js';
$CSSPath1 = './../css/login.css';
$CSSPath2 = '';
$CSSPath3 = '';
require_once(__DIR__ . '/head.php');

?>

<body>
<?php 
$logoPath = './index.php'; 
require_once(__DIR__ . '/header.php');
?>
<!-- message -->
<?php if (!empty($_SESSION['messages'])) : ?>
  <div class="message">
    <p class="message__text"><?= h($app->getMessage($_SESSION['messages']))  ?></p>
  </div>
<?php endif; ?>
  
  <!-- login -->    
<section id="login" class="login">
    <div class="login__content-wrap">
      <p class="login__title">login</p>
      <!-- signup link -->
      <p class="login__to-signup fz--small">You don't have an account yet? Please <a class="color--blue" href="./signup.php">sign up here</a>.</p>
      <p class="has-error margin--0"><?= $app->getErrors('common'); ?></p>
      <form action="" method="post">
      <!-- email -->
      <p class="has-error margin--0"><?= $app->getErrors('email'); ?></p>
      <label for="email">
        <p>
          <input type="text" name="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>" placeholder="email"> 
        </p>
      </label>
      <!-- password -->
      <p class="has-error margin--0"><?= $app->getErrors('password'); ?></p>
      <label for="password">
        <p>
          <input type="password" name="password" placeholder="password"> 
        </p>
      </label>
      <!-- forgotten password -->
      <p class="login__to-issueCode fz--small">You have<a class="color--blue" href="./issueCode.php"> forgotten password?</a></p>
      <!-- token -->
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <p>
        <input class="login__submit" type="submit" value="Log in">
      </p>
      </form>
    </div>
  </section>
</body>
</html>