<?php

require_once(__DIR__ . '/../config/config.php');
trackingStart();

$app = new MyApp\Controller\Cancel();
$app->run();

//<head>
$requestPage = 'CANCEL -';
$jsPath = './../js/cancel.js';
$CSSPath = './../css/cancel.css';
require_once(__DIR__ . '/head.php');
//</head>

?>

<body>
<!-- cancel -->    
<section id="cancel" class="cancel">
      <div class="cancel__content-wrap">
      <p class="cancel__title">Cancel</p>
      <p class="cancel__notice fz--small">※Please note that you will be not able to retrieve your account once you cancel your account.</p>
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
      <!-- agree -->
      <label class="agree-label">
        <p class="fz--small">
          <input class="agree" type="checkbox" name="agree">
          I agree to <span class="color--blue"><a href=""> Duplazy terms</a></span>
        </p>
      </label>
      <!-- token -->
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <p>
        <input class="cancel__submit" type="submit" value="Cancl">
      </p>
      </form>
    </div>
  </section>
</body>
</html>