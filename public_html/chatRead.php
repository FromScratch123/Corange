
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\ChatRead();
  $app->run();
  $requestPage = 'CHAT -';
  $jsPath1 = './../js/chat.js';
  $jsPath2 = '';
  $jsPath3 = '';
  $jsPath4 = '';
  $jsPath5 = '';
  $CSSPath1 = './../CSS/chat.css';
  $CSSPath2 = './../CSS/accountField.css';
  $CSSPath3 = './../CSS/aside.css';
  $CSSPath4 = '';
  $CSSPath5 = '';
  
  require_once(__DIR__ . '/head.php');

  ?>

