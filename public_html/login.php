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
$CSSPath = './../css/login.css';
require_once(__DIR__ . '/head.php');

?>

<body>
<?php require_once(__DIR__ . '/header.php') ?>
  <!-- login -->    
<section id="login" class="login">
    <div class="login__content-wrap">
      <p class="login__title">login</p>
      <form action="" method="post">
      <!-- email -->
      <label for="email">
        <p>
          <input type="text" name="email" placeholder="email"> 
        </p>
      </label>
      <!-- password -->
      <label for="password">
        <p>
          <input type="password" name="password" placeholder="password"> 
        </p>
      </label>
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