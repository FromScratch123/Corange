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
<!-- jQuery CDN -->
<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
<!-- jQuery UI CDN -->
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
<!-- JavaScript -->
<script src="./../js/main.js"></script> 
<!-- CSS -->
  <!-- Reset CSS -->
  <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/> 
  <!-- Main CSS-->
  <link rel="stylesheet" href="./../css/main.css"> 
  <!-- home CSS -->
  <link rel="stylesheet" href="./../css/home.css">
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
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<!-- favicon -->
  <link rel="icon" type="image/x-icon" href="./favicon.ico">
  <link rel="apple-touch-icon" href="./apple-touch-icon.png" sizes="180x180">
  
</head>
<body>
<header class="header">
  <!-- logo -->
  <p class="header__logo"><a href="">Duplazy</a></p>
  <!-- sign up / sign in -->
  <div class="header__direction-wrap">
  <p class="header__signin"><a href="#signin">Sign In</a></p>
  <p class="header__signup"><a href="#signin">Sign Up</a></p>
  </div>
</header>
<div class="account-field">
  <!-- friend icon -->
  <div class="account-field__icons-flex-container flex-container">
  <!-- friend icon -->
  <i class="account-field__icon icon--black fas fa-user-friends"></i>
  <!-- chat icon -->
  <i class="account-field__icon icon--black fas fa-comment-dots"></i>
  <!-- bell icon -->
  <i class="account-field__icon icon--black fas fa-bell"></i>
  <!-- share btn -->
  <button class="account-field__btn">
    <span class=account-field__btn--share>SHARE</span>
    <i class="account-field__icon account-field__icon--share icon--white fas fa-share-alt"></i>
  </button>
  <!-- account menu -->
  <span class="account-field__user-menu"></span>
  <!-- user icon -->
  <div class="account-field__user-icon-wrap">
    <img src="./../images/user_icon.png" alt="ユーザーのアイコン画像" class="account-field__user-icon">
  </div>
  </div>
</div>

<aside class="side-menu">
  <ul class="categories">
    <li class="categories__list"><i class="categories-icon fas fa-folder-open"></i>My Project</li>
    <li class="categories__list"><i class="categories-icon fab fa-slideshare"></i>Share
    <li class="categories__list"><i class="categories-icon fas fa-clock"></i>Recent</li>
    <li class="categories__list"><i class="categories-icon fas fa-flag"></i>Flag</li>
    <li class="categories__list"><i class="categories-icon fas fa-trash-alt"></i>Trash</li>
  </ul>
  <!-- search window -->
  <form class="side-menu__search-window--wrap action="" method="get">
    <input class="side-menu__search-window" type="text" name="search" placeholder="search..."><i class="side-menu__search-window--icon fas fa-search"></i>
  </form>
  <!-- create project btn -->
  <button class="side-menu__create-btn">New Project</button>
</aside>
  
<main>
  <div class="project-window">
    <div class="project-window__overroll--flex flex-container">
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
      <div class="project">
        <i class="folder-icon fas fa-folder"></i>
        <p>Project Name</p>
        <p>2020-01-01</p>
      </div>
    </div>
    <div class="tool-bar--flex-container flex-container">
      <div class="tool-bar__breadcrumbs">
        <span>Home >> My Project >> 最近使用したファイル</span>
      </div>
      <div class="tool-bar__sort">
        <ul class="tool-bar__sort-flex-container flex-container">
          <li class="sort-icon"><i class="fas fa-sort-alpha-down"></i></li>
          <li class="sort-icon"><i class="fas fa-sort-alpha-up"></i></li>
          <li class="sort-icon"><i class="far fa-clock"></i></li>
        </ul>
      </div>
    </div>
    <div class="project-window__details">
      <table class="project-window__table">
        <tbody>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu"><i class="menu fas fa-ellipsis-h"></i></td>
            </tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu"><i class="menu fas fa-ellipsis-h"></i></td>
            </tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu"><i class="menu fas fa-ellipsis-h"></i></td>
            </tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu"><i class="menu fas fa-ellipsis-h"></i></td>
            </tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu"><i class="menu fas fa-ellipsis-h"></i></td>
            </tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu"><i class="menu fas fa-ellipsis-h"></i></td>
            </tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu"><i class="menu fas fa-ellipsis-h"></i></td>
            </tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu"><i class="menu fas fa-ellipsis-h"></i></td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>

</main>
</body>
</html>