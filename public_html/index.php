<?php

require_once(__DIR__ . '/../config/config.php');
trackingStart();
$app = new MyApp\Controller\Signup();


// $app = new MyApp\Controller\Index();

$app->run();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" 
  content="あなたの仕事を効率化させる為のツールです。無料で誰でも簡単に使え、重複したデータ入力を最適化します。">
  <meta rel="canonical" href="">
  <title>Duplazy | もっと簡単に、もっと楽に。</title>
<!-- CSS -->
  <!-- Reset CSS -->
  <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/> 
  <!-- Main CSS-->
  <link rel="stylesheet" href="./../css/main.css"> 
<!-- CARD -->
  <meta property="og:url" content="">
  <meta property="og:title" content="Duplazy | もっと簡単に、もっと楽に。">
  <meta property="og:type" content="website">
  <meta property="og:description" content="あなたの仕事を効率化させる為のツールです。無料で誰でも簡単に使え、重複したデータ入力を最適化します。">
  <meta property="og:image" content="img/home_hero.jpg">
  <meta property="twitter:card" 
  content="summary">
  <meta name="twitter:site" content="@">
  <meta property="og:site_name" content="Duplazy | もっと簡単に、もっと楽に。">
  <meta property="og:locale" content="ja_JP">
  <meta property="fb:app_id" content="">
<!-- Fonts & Icons -->
  <link rel="icon" href="favicon.ico" sizes="16x16" type="image/mage/vnd.microsoft.icon">
  <link rel="icon" href="favicon.ico" sizes="32x32" type="image/mage/vnd.microsoft.icon">
  <link rel="icon" href="favicon.ico" sizes="48x48" type="image/mage/vnd.microsoft.icon">
  <link rel="icon" href="favicon.ico" sizes="62x62" type="image/mage/vnd.microsoft.icon"> 
  <!-- windows icon-->
  <meta name="msapplication-TileImage" content="img/icons/windows_icon.png"> 
  <meta name="msapplication-TileColor" content="#8A4DA5">
  <!-- smartphone icon-->
  <link  rel="apple-touch-icon-precomposed" href="img/icons/smart_phone_icon.png"> 
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Oswald|Sawarabi+Gothic&display=swap" rel="stylesheet">
  <!--FontAwesome -->
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"> 
<!-- favicon -->
  <link rel="icon" type="image/x-icon" href="./favicon.ico">
  <link rel="apple-touch-icon" href="./apple-touch-icon.png" sizes="180x180">
</head>
<body>
<!-- hero -->
  <div class="hero">
    <header class="header">
      <!-- logo -->
      <p class="header__logo"><a href="">Duplazy</a></p>
      <!-- sign up / sign in -->
      <div class="header__direction-wrap">
      <p class="header__signin"><a href="#signin">Sign In</a></p>
      <p class="header__signup"><a href="#signin">Sign Up</a></p>
      </div>
    </header>
    <!-- text -->
      <p class="hero__text">Make work easy<br>let you lazy</p>
    <!-- btn -->
    <button class="hero__signup-btn">Sign Up Now!</button>
    <button class="hero__about-btn">About Duplazy</button>

<!-- signup drawer -->    
    <div class="signup-drawer">
      <button class="signup-drawer__times">
        <i class="fas fa-times"></i>
      </button>
      <div class="sigup-drawer__content-wrap">
      <p class="signup-drawer__title">Sign Up</p>
      <p class="signup-drawer__to-signin fz--small">or <a class="color--blue" href="#">Sign In</a> your account</p>
      <form action="" method="post">
      <!-- surname -->
      <label for="surname">
        <p>
          <input type="text" name="surname" placeholder="surname"> 
        </p>
      </label>
      <!-- givenname -->
      <label for="givenname">
        <p>
          <input type="text" name="givenname" placeholder="givenname"> 
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
          <input type="text" name="password" placeholder="password"> 
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
        <input class="signup-drawer__submit" type="submit" value="Sign Up">
      </p>
      </form>
      </div>
    </div>
  </div>
</body>
</html>