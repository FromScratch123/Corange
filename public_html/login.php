<?php

require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Login();

$app->run();

var_dump(SITE_URL);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" 
  content="大阪城公園で営業しているエステティックサロンです。最高品質の施術で、美を追求するすべての人にその人本来の美しさに磨きをかけます。">
  <meta rel="canonical" href="">
  <title>Reluxuriest | 美しさは、芸術だ。</title>
<!-- CSS -->
  <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/> <!-- Reset CSS -->
  <link rel="stylesheet" href="css/main.css"> <!-- Main CSS-->
  <link rel="stylesheet" href="css/login.css"> <!-- login CSS-->
<!-- CARD -->
  <meta property="og:url" content="">
  <meta property="og:title" content="Reluxuriest | 美しさは、芸術だ。">
  <meta property="og:type" content="website">
  <meta property="og:description" content="大阪城公園で営業しているエステティックサロンです。最高品質の施術で、美を追求するすべての人にその人本来の美しさに磨きをかけます。">
  <meta property="og:image" content="img/home_hero.jpg">
  <meta property="twitter:card" 
  content="summary">
  <meta name="twitter:site" content="@">
  <meta property="og:site_name" content="Reluxuriest | 美しさは、芸術だ。">
  <meta property="og:locale" content="ja_JP">
  <meta property="fb:app_id" content="">
<!-- Fonts & Icons -->
  <link rel="icon" href="favicon.ico" sizes="16x16" type="image/mage/vnd.microsoft.icon">
  <link rel="icon" href="favicon.ico" sizes="32x32" type="image/mage/vnd.microsoft.icon">
  <link rel="icon" href="favicon.ico" sizes="48x48" type="image/mage/vnd.microsoft.icon">
  <link rel="icon" href="favicon.ico" sizes="62x62" type="image/mage/vnd.microsoft.icon"> 
  <meta name="msapplication-TileImage" content="img/icons/windows_icon.png"> 
  <meta name="msapplication-TileColor" content="#8A4DA5">
  <!-- windows icon-->
  <link  rel="apple-touch-icon-precomposed" href="img/icons/smart_phone_icon.png"> 
  <!-- smartphone icon-->
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> <!-- Material Icons-->
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"> <!--FontAwesome -->
<!-- favicon -->
  <link rel="icon" type="image/x-icon" href="./favicon.ico">
  <link rel="apple-touch-icon" href="./apple-touch-icon.png" sizes="180x180">
</head>
<body>
  <div id="container">
    <form action="" method="post">
      <p>
        <input type="text" name="email" placeholder="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>">
      </p>
        <input type="text" name="password" placeholder="password">
      </p>
      <p class="error"><?= h($app->getErrors('login')); ?></p>
      <p>
      <input type="submit" values="log In">
      <p><a href="./signup.php">Sign Up</a></p>
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form> 
  </div>
</body>
</html>