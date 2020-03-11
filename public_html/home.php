
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();
  $requestPage = 'HOME -';
  $jsPath = './../js/home.js';
  $CSSPath1 = './../CSS/home.css';
  $CSSPath2 = './../CSS/accountField.css';
  $CSSPath3 = './../CSS/aside.css';
  require_once(__DIR__ . '/head.php');

  ?>

<body>
<?php 
$logoPath = '';
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/accountField.php');
require_once(__DIR__ . '/aside.php');
 ?>



  
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