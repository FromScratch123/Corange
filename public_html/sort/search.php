<!-- search -->
<div class="tool-bar__sort">
        <ul class="tool-bar__sort--flex flex-container">
          <!-- title asc -->
          <li class="sort-icon">
            <a href="./searchWork.php<?= substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'], '?', 0)) ?>&sort=AA">
              <i class="fas fa-sort-alpha-down"></i></li>
            </a>
          <!-- title desc -->
          <li class="sort-icon">
            <a href="./searchWork.php<?= substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'], '?', 0)) ?>&sort=AD">
              <i class="fas fa-sort-alpha-up"></i></li>
            </a>
          <!-- time asc -->
          <li class="sort-icon">
            <a href="./searchWork.php<?= substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'], '?', 0)) ?>&sort=DA">
              <i class="sort-icon__clock fas fa-history"></i>
            </a>
          </li>
          <!-- time desc -->
          <li class="sort-icon">
            <a href="./searchWork.php<?= substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'], '?', 0)) ?>&sort=DD">
              <i class="fas fa-history"></i>
            </a>
          </li>
        </ul>
      </div>
     
