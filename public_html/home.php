
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $requestPage = 'HOME -';
  $jsPath = './../js/home.js';
  $CSSPath = './../CSS/home.css';
  require_once(__DIR__ . '/head.php');

  ?>

<body>
<?php require_once(__DIR__ . '/header.php') ?>
<div class="account-field">
  <!-- friend icon -->
  <div class="account-field__icons-flex-container flex-container">
  <!-- friend icon -->
  <i class="account-field__icon icon--black fas fa-user-friends"></i>
  <!-- chat icon -->
  <i class="account-field__icon icon--black fas fa-comment-dots"></i>
  <!-- bell icon -->
  <i class="account-field__icon icon--black bell-icon fas fa-bell">
  <span class="notification">1</span>
  </i>
  <!-- share btn -->
  <button class="account-field__btn">
    <span class=account-field__btn--share>SHARE</span>
    <i class="account-field__icon account-field__icon--share icon--white fas fa-share-alt"></i>
  </button>
  <!-- account menu -->
  <i id="user-menu-trigger" class="user-menu-trigger menu fas fa-ellipsis-h">
  <!-- menu list -->
  <div class="user-menu-box js--hidden">
    <ul>
      <li class="user-menu-list"><i class="user-menu-icon far fa-address-card"></i><a href="">プロフィール</a></li>
      <li class="user-menu-list"><i class="user-menu-icon fas fa-cog"></i><a href="">設定</a></li>
      <li class="user-menu-list"><i class="user-menu-icon far fa-question-circle"></i><a href="">ヘルプ</a></li>
      <li class="user-menu-list"><i class="user-menu-icon fas fa-sign-out-alt"></i><a href="./logout.php">ログアウト</a></li>
      <li class="user-menu-list"><i class="user-menu-icon fas fa-user-slash"></i><a href="./cancel.php">退会</a></li>
    </ul>
  </div>
  </i>
  <!-- user icon -->
  <div class="account-field__user-icon-wrap">
    <img src="./../images/user_icon.png" alt="ユーザーのアイコン画像" class="account-field__user-icon">
  </div>
  </div>
</div>

<aside class="side-menu">
  <ul class="categories">
    <li class="categories__list"><i class="categories-icon fas fa-folder-open"></i><a href="">My Project</a></li>
    <li class="categories__list"><i class="categories-icon fab fa-slideshare"></i><a href="">Share
    <li class="categories__list"><i class="categories-icon fas fa-clock"></i><a href="">Recent</a></li>
    <li class="categories__list"><i class="categories-icon fas fa-flag"></i><a href="">Flag</a></li>
    <li class="categories__list"><i class="categories-icon fas fa-trash-alt"></i><a href="">Tras</a>h</li>
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
    <div id="tool-bar" class="tool-bar--flex-container flex-container">
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
              <td class="file-menu">
                <i id="file-menu-trigger" class="file-menu-trigger menu fas fa-ellipsis-h">
                <div class="file-menu-box js--hidden">
      <ul>
        <li class="file-menu-list">
          <a href="">名前変更</a>
        </li>
        <li class="file-menu-list">
          <a href="">編集</a>
        </li>
        <li class="file-menu-list">
          <a href="">削除</a>
        </li>
        <li class="file-menu-list">
          <a href="">共有</a>
        </li>
        <li class="file-menu-list">
          <a href="">ヘルプ</a>
        </li>
      </ul>
    </div>
                </i>
              </td>
            </tr>
            <tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu">
                <i id="file-menu-trigger" class="file-menu-trigger menu fas fa-ellipsis-h">
                <div class="file-menu-box js--hidden">
      <ul>
        <li class="file-menu-list">
          <a href="">名前変更</a>
        </li>
        <li class="file-menu-list">
          <a href="">編集</a>
        </li>
        <li class="file-menu-list">
          <a href="">削除</a>
        </li>
        <li class="file-menu-list">
          <a href="">共有</a>
        </li>
        <li class="file-menu-list">
          <a href="">ヘルプ</a>
        </li>
      </ul>
    </div>
                </i>
              </td>
            </tr>
            <tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu">
                <i id="file-menu-trigger" class="file-menu-trigger menu fas fa-ellipsis-h">
                <div class="file-menu-box js--hidden">
      <ul>
        <li class="file-menu-list">
          <a href="">名前変更</a>
        </li>
        <li class="file-menu-list">
          <a href="">編集</a>
        </li>
        <li class="file-menu-list">
          <a href="">削除</a>
        </li>
        <li class="file-menu-list">
          <a href="">共有</a>
        </li>
        <li class="file-menu-list">
          <a href="">ヘルプ</a>
        </li>
      </ul>
    </div>
                </i>
              </td>
            </tr>
            <tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu">
                <i id="file-menu-trigger" class="file-menu-trigger menu fas fa-ellipsis-h">
                <div class="file-menu-box js--hidden">
      <ul>
        <li class="file-menu-list">
          <a href="">名前変更</a>
        </li>
        <li class="file-menu-list">
          <a href="">編集</a>
        </li>
        <li class="file-menu-list">
          <a href="">削除</a>
        </li>
        <li class="file-menu-list">
          <a href="">共有</a>
        </li>
        <li class="file-menu-list">
          <a href="">ヘルプ</a>
        </li>
      </ul>
    </div>
                </i>
              </td>
            </tr>
            <tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu">
                <i id="file-menu-trigger" class="file-menu-trigger menu fas fa-ellipsis-h">
                <div class="file-menu-box js--hidden">
      <ul>
        <li class="file-menu-list">
          <a href="">名前変更</a>
        </li>
        <li class="file-menu-list">
          <a href="">編集</a>
        </li>
        <li class="file-menu-list">
          <a href="">削除</a>
        </li>
        <li class="file-menu-list">
          <a href="">共有</a>
        </li>
        <li class="file-menu-list">
          <a href="">ヘルプ</a>
        </li>
      </ul>
    </div>
                </i>
              </td>
            </tr>
            <tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu">
                <i id="file-menu-trigger" class="file-menu-trigger menu fas fa-ellipsis-h">
                <div class="file-menu-box js--hidden">
      <ul>
        <li class="file-menu-list">
          <a href="">名前変更</a>
        </li>
        <li class="file-menu-list">
          <a href="">編集</a>
        </li>
        <li class="file-menu-list">
          <a href="">削除</a>
        </li>
        <li class="file-menu-list">
          <a href="">共有</a>
        </li>
        <li class="file-menu-list">
          <a href="">ヘルプ</a>
        </li>
      </ul>
    </div>
                </i>
              </td>
            </tr>
            <tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu">
                <i id="file-menu-trigger" class="file-menu-trigger menu fas fa-ellipsis-h">
                <div class="file-menu-box js--hidden">
      <ul>
        <li class="file-menu-list">
          <a href="">名前変更</a>
        </li>
        <li class="file-menu-list">
          <a href="">編集</a>
        </li>
        <li class="file-menu-list">
          <a href="">削除</a>
        </li>
        <li class="file-menu-list">
          <a href="">共有</a>
        </li>
        <li class="file-menu-list">
          <a href="">ヘルプ</a>
        </li>
      </ul>
    </div>
                </i>
              </td>
            </tr>
            <tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu">
                <i id="file-menu-trigger" class="file-menu-trigger menu fas fa-ellipsis-h">
                <div class="file-menu-box js--hidden">
      <ul>
        <li class="file-menu-list">
          <a href="">名前変更</a>
        </li>
        <li class="file-menu-list">
          <a href="">編集</a>
        </li>
        <li class="file-menu-list">
          <a href="">削除</a>
        </li>
        <li class="file-menu-list">
          <a href="">共有</a>
        </li>
        <li class="file-menu-list">
          <a href="">ヘルプ</a>
        </li>
      </ul>
    </div>
                </i>
              </td>
            </tr>
            <tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu">
                <i id="file-menu-trigger" class="file-menu-trigger menu fas fa-ellipsis-h">
                <div class="file-menu-box js--hidden">
      <ul>
        <li class="file-menu-list">
          <a href="">名前変更</a>
        </li>
        <li class="file-menu-list">
          <a href="">編集</a>
        </li>
        <li class="file-menu-list">
          <a href="">削除</a>
        </li>
        <li class="file-menu-list">
          <a href="">共有</a>
        </li>
        <li class="file-menu-list">
          <a href="">ヘルプ</a>
        </li>
      </ul>
    </div>
                </i>
              </td>
            </tr>
            <tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu">
                <i id="file-menu-trigger" class="file-menu-trigger menu fas fa-ellipsis-h">
                <div class="file-menu-box js--hidden">
      <ul>
        <li class="file-menu-list">
          <a href="">名前変更</a>
        </li>
        <li class="file-menu-list">
          <a href="">編集</a>
        </li>
        <li class="file-menu-list">
          <a href="">削除</a>
        </li>
        <li class="file-menu-list">
          <a href="">共有</a>
        </li>
        <li class="file-menu-list">
          <a href="">ヘルプ</a>
        </li>
      </ul>
    </div>
                </i>
              </td>
            </tr>
            <tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu">
                <i id="file-menu-trigger" class="file-menu-trigger menu fas fa-ellipsis-h">
                <div class="file-menu-box js--hidden">
      <ul>
        <li class="file-menu-list">
          <a href="">名前変更</a>
        </li>
        <li class="file-menu-list">
          <a href="">編集</a>
        </li>
        <li class="file-menu-list">
          <a href="">削除</a>
        </li>
        <li class="file-menu-list">
          <a href="">共有</a>
        </li>
        <li class="file-menu-list">
          <a href="">ヘルプ</a>
        </li>
      </ul>
    </div>
                </i>
              </td>
            </tr>
            <tr>
            <tr>
              <!-- file name -->
              <th class="file-name"><i class="file-icon fas fa-file-alt"></i>file name</th>
              <!-- time -->
              <td class="file-time"><time>2020-02-28 10:30</time></td>
              <!-- file menu -->
              <td class="file-menu">
                <i id="file-menu-trigger" class="file-menu-trigger menu fas fa-ellipsis-h">
                <div class="file-menu-box js--hidden">
      <ul>
        <li class="file-menu-list">
          <a href="">名前変更</a>
        </li>
        <li class="file-menu-list">
          <a href="">編集</a>
        </li>
        <li class="file-menu-list">
          <a href="">削除</a>
        </li>
        <li class="file-menu-list">
          <a href="">共有</a>
        </li>
        <li class="file-menu-list">
          <a href="">ヘルプ</a>
        </li>
      </ul>
    </div>
                </i>
              </td>
            </tr>
            <tr>
              
            
        </tbody>
      </table>
      <footer class="footer">
        
      </footer>
    </div>
  </div>

</main>
</body>
</html>