<?php

require_once(__DIR__ . '/../config/config.php');
//log header
trackingStart();
//IssueCode Controller読込
$app = new MyApp\Controller\IssueCode();
//ログイン状態の確認
$app->run();

//HTML 
//head読込
$requestPage = 'Issue code -';
$jsPath = './../js/issueCode.js';
$CSSPath1 = './../css/issueCode.css';
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
<section id="issue-code" class="issue-code">
    <div class="issue-code__content-wrap">
      <p class="issue-code__title">Issue code</p>
      <!-- signup link -->
      <p class="issue-code__to-signup fz--small">You don't have an account yet? Please <a class="color--blue" href="./signup.php">sign up here</a>.</p>
      <p class="has-error margin--0"><?= $app->getErrors('common'); ?></p>
      <form action="" method="post">
      <!-- email -->
      <p class="has-error margin--0"><?= $app->getErrors('mail'); ?></p>
      <label for="email">
        <p>
          <input type="text" name="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>" placeholder="email"> 
        </p>
      </label>
      <!-- email confirmation -->
      <p class="has-error margin--0"><?= $app->getErrors('email-confirmation'); ?></p>
      <label for="email-confirmation">
        <p>
          <input type="text" name="email-confirmation" placeholder="email (confirmation)" autocomplete="off"> 
        </p>
      </label>
      <!-- token -->
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <p>
        <input class="issue-code__submit" type="submit" value="Isuue code">
      </p>
      </form>
    </div>
  </section>
</body>
</html>