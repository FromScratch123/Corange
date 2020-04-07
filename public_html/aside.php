<aside class="side-menu">
  <ul class="categories">
    <li class="categories__list"><a href="./searchWork.php?my=<?= $_SESSION['me']->id ?>"><i class="categories-icon fas fa-folder-open"></i></a><a class="categories__list-text" href="./searchWork.php?my=<?= $_SESSION['me']->id ?>">My Work</a></li>
    <li class="categories__list"><a href="./searchWork.php?all=<?= $_SESSION['me']->id ?>"><i class="categories-icon fab fa-slideshare"></i></a><a class="categories__list-text" href="./searchWork.php?all=<?= $_SESSION['me']->id ?>">All Work</a></li>
    
    <li class="categories__list"><a href="./searchWork.php?favorite=<?= $_SESSION['me']->id ?>"><i class="categories-icon fas fa-thumbs-up"></i></a><a class="categories__list-text" href="./searchWork.php?favorite=<?= $_SESSION['me']->id ?>">Favorite</a></li>
    <li class="categories__list"><a href="./searchWork.php?trash=<?= $_SESSION['me']->id ?>"><i class="categories-icon fas fa-trash-alt"></i></a><a class="categories__list-text" href="./searchWork.php?trash=<?= $_SESSION['me']->id ?>">Trash</a></li>
  </ul>
  <!-- search window -->
  <form class="side-menu__search-window--wrap" action="./searchWork.php" method="get">
    <input class="side-menu__search-window" type="text" name="search" placeholder="search..."><i class="side-menu__search-window--icon fas fa-search"></i>
  </form>
  <!-- create work btn -->
  <button class="side-menu__create-btn--large-screen">New Work</button>
  <button class="side-menu__create-btn--small-screen"><i class="create-icon fas fa-plus"></i></button>

</aside>