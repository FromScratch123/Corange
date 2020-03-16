<?php

require_once(__DIR__ . '/../config/config.php');
//log header
trackingStart();
//ConfirmCode Controller読込
$app = new MyApp\Controller\ConfirmCode();
//ログイン状態の確認
$app->run();

//HTML 
//head読込
$requestPage = 'Confirm code -';
$jsPath = './../js/confirmCode.js';
$CSSPath1 = './../css/confirmCode.css';
$CSSPath2 = '';
$CSSPath3 = '';
require_once(__DIR__ . '/head.php');

?>

<body>
<?php 
$logoPath = './index.php'; 
require_once(__DIR__ . '/header.php');
?>
  <!-- issue code -->    
<section id="confirm-code" class="confirm-code">
    <div class="confirm-code__content-wrap">
      <p class="confirm-code__title">Enter code</p>
      <p class="has-error margin--0"><?= $app->getErrors('common'); ?></p>
      <form action="" method="post">
      <!-- email -->
      <p class="has-error margin--0"><?= $app->getErrors('mail'); ?></p>
      <label for="email">
        <p>
          <input type="text" name="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>" placeholder="email"> 
        </p>
      </label>
      <!-- auth code -->
      <p class="has-error margin--0"><?= $app->getErrors('code'); ?></p>
      <label for="code">
        <p>
          <input type="text" name="code" placeholder="code" autocomplete="off"> 
        </p>
      </label>
      <!-- token -->
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <p>
        <input class="confirm-code__submit" type="submit" value="Reset password">
      </p>
      </form>
    </div>
  </section>
</body>
</html>