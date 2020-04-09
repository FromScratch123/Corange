 <!-- All Work -->
 <div class="tool-bar__sort">
        <ul class="tool-bar__sort--flex flex-container">
          <!-- title asc -->
          <li class="sort-icon">
            <a href="./searchWork.php?all=<?= $_SESSION['me']->id ?>&sort=AA">
              <i class="fas fa-sort-alpha-down"></i></li>
            </a>
          <!-- title desc -->
          <li class="sort-icon">
            <a href="./searchWork.php?all=<?= $_SESSION['me']->id ?>&sort=AD">
              <i class="fas fa-sort-alpha-up"></i></li>
            </a>
          <!-- time asc -->
          <li class="sort-icon">
            <a href="./searchWork.php?all=<?= $_SESSION['me']->id ?>&sort=DA">
              <i class="sort-icon__clock fas fa-history"></i>
            </a>
          </li>
          <!-- time desc -->
          <li class="sort-icon">
            <a href="./searchWork.php?all=<?= $_SESSION['me']->id ?>&sort=DD">
              <i class="fas fa-history"></i>
            </a>
          </li>
        </ul>
      </div>
     
