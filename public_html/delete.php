<?php

require_once(__DIR__ . '/../config/config.php');
trackingStart();
var_dump(print_r( $_SERVER['HTTP_REFERER'], true));
$app = new MyApp\Controller\Delete();
$app->run();

//<head>
$requestPage = 'delete -';
$jsPath = './../js/delete.js';
$CSSPath1 = './../css/delete.css';
$CSSPath2 = '';
$CSSPath3 = '';
require_once(__DIR__ . '/head.php');
//</head>

?>

<body>
<?php 
$logoPath = './index.php'; 
require_once(__DIR__ . '/header.php');
?>
<!-- delete -->    
<section id="delete" class="delete">
      <div class="delete__content-wrap">
      <p class="delete__title">Delete account</p>
      <p class="has-error color--red"><?= $app->getErrors('common') ?></p>
      <p class="delete__notice fz--small">※Please note that you will be not able to retrieve your account once you delete your account.</p>
      <form action="" method="post">
      <!-- reason -->
      <label for="reason">
        <p>
          <select name="reason">
            <option value="default" selected>Why are you leaving?</option>
            <option value="no-need">I don't need it anymore.</option>
            <option value="hard-to-use">It's hard to use.</option>
            <option value="switch-to-others">I will use other similar services.</option>
            <option value="others">Others</option>
          </select>
        </p>
      </label>
      <!-- make it better -->
      <label for="better">
        <p>
          <select name="better">
            <option value="default" selected>What make us better?</option>
            <option value="design">To improve the design.</option>
            <option value="functions">To enhance the functions.</option>
            <option value="compatibility">To be compatible with any files.</option>
          </select>
        </p>
      </label>
      <!-- email -->
      <p class="has-error margin--0"><?= $app->getErrors('email'); ?></p>
      <label for="email">
      <span class="color--red">※</span>
        <p class="margin--0">
          <input type="text" name="email" placeholder="email"> 
        </p>
      </label>
      <!-- password -->
      <p class="has-error margin--0"><?= $app->getErrors('password'); ?></p>
      <label for="password">
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
        <input class="delete__submit" type="submit" value="Delete account">
      </p>
      </form>
    </div>
  </section>
</body>
</html>