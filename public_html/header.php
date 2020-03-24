<header class="header">
  <!-- logo -->
  <p class="header__logo"><a href="<?= $logoPath ?>">Duplazy</a></p>

  <!-- sign up / sign in -->
  <?php if (!isset($_SESSION['me']) && empty($_SESSION['me'])) : ?> 
  <div class="header__direction-wrap">
  <p class="header__login"><a href="./login.php"></a></p>
  <p class="header__signup"><a href="./signup.php">Sign Up</a></p>
  </div>
  <?php endif; ?>
</header>
