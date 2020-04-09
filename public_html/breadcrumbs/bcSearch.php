   <!-- TOP FLOOR -->
      <!-- HOME -->
      <li itemprop="itemListElement" itemscope
          itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="./home.php">
            <i class="fas fa-home"></i>
            <span itemprop="name" class="breadcrumbs-name">HOME</span>
        </a>
        <meta itemprop="position" content="1" />
        <i class="breadcrumbs-right fas fa-angle-double-right"></i>
      </li>
      <!-- SECOND FLOOR -->
      <!-- my work -->
      <li itemprop="itemListElement" itemscope
          itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="./searchWork.php<?= substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'], '?', 0)) ?>">
            <i class="fas fa-search"></i>
            <span itemprop="name" class="breadcrumbs-name">Search</span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
     
