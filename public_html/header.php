<header class="header">
  <!-- logo -->
  <p class="header__logo"><a href="<?= $logoPath ?>">Duplazy</a></p>
  <!-- sign up / sign in -->
  <div class="header__direction-wrap">
  <p class="header__login"><a href="./login.php">Log In</a></p>
  <p class="header__signup"><a href="./signup.php">Sign Up</a></p>
  </div>
</header>

<!-- message -->
<!-- <?php if (!empty($_SESSION['messages'])) : ?>
  <div class="message">
    <p class="message__text"><?= h($app->getMessage($_SESSION['messages']))  ?></p>
  </div>
<?php endif; ?> -->