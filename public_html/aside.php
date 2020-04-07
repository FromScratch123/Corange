<aside class="side-menu">
  <ul class="categories">
    <li class="categories__list"><a href="./searchWork.php?search=<?= $_SESSION['me']->id ?>"><i class="categories-icon fas fa-folder-open"></i></a><a class="categories__list-text" href="./searchWork.php?search=<?= $_SESSION['me']->id ?>">My Work</a></li>
    <li class="categories__list"><a href=""><i class="categories-icon fab fa-slideshare"></i></a><a class="categories__list-text" href="">All Work
    <li class="categories__list"><a href=""><i class="categories-icon fas fa-clock"></i></a><a class="categories__list-text" href="">Recent</a></li>
    <li class="categories__list"><a href=""><i class="categories-icon fas fa-thumbs-up"></i></a><a class="categories__list-text" href="">Favorite</a></li>
    <li class="categories__list"><a href=""><i class="categories-icon fas fa-trash-alt"></i></a><a class="categories__list-text" href="">Trash</a></li>
  </ul>
  <!-- search window -->
  <form class="side-menu__search-window--wrap" action="./searchWork.php" method="get">
    <input class="side-menu__search-window" type="text" name="search" placeholder="search..."><i class="side-menu__search-window--icon fas fa-search"></i>
  </form>
  <!-- create work btn -->
  <button class="side-menu__create-btn--large-screen">New Work</button>
  <button class="side-menu__create-btn--small-screen"><i class="create-icon fas fa-plus"></i></button>

</aside>