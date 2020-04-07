
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\NotificationRead();
  $app->run();
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

