<?php

require_once(__DIR__ . '/../config/config.php');
//log header
trackingStart();
//ChangePass Controller読込
$app = new MyApp\Controller\ChangePass();
//ログイン状態の確認
$app->run();

//HTML 
//head読込
$requestPage = 'Change password -';
$jsPath1 = './../js/changePass.js';
$jsPath2 = '';
$jsPath3 = '';
$jsPath4 = '';
$jsPath5 = '';
$CSSPath1 = './../css/changePass.css';
$CSSPath2 = '';
$CSSPath3 = '';
$CSSPath4 = '';
$CSSPath5 = '';
require_once(__DIR__ . '/head.php');

?>

<body>
<?php 
$logoPath = './index.php'; 
require_once(__DIR__ . '/header.php');
?>
  
  <!-- issue code -->    
<section id="change-pass" class="change-pass">
    <div class="change-pass__content-wrap">
      <p class="change-pass__title">Change password</p>
      <p class="has-error margin--0"><?= $app->getErrors('common'); ?></p>
      <form action="" method="post">
      <!-- current password -->
      <p class="has-error margin--0"><?= $app->getErrors('current-password'); ?></p>
      <label for="current-password">
        <p>
          <input type="password" name="current-password" placeholder="current password"> 
        </p>
      </label>
      <!-- password -->
      <p class="has-error margin--0"><?= $app->getErrors('password'); ?></p>
      <label for="password">
        <p>
          <input type="password" name="password" placeholder="new password"> 
        </p>
      </label>
      <!-- password confirmation -->
      <p class="has-error margin--0"><?= $app->getErrors('password-confirmation'); ?></p>
      <label for="new password-confirmation">
        <p>
          <input type="password" name="password-confirmation" placeholder="password (confirmation)" autocomplete="off"> 
        </p>
      </label>
      <!-- token -->
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <p>
        <input class="change-pass__submit" type="submit" value="Change password">
      </p>
      </form>
    </div>
  </section>
</body>
</html>