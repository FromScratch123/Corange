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
      <li class="user-menu-list"><i class="user-menu-icon far fa-address-card"></i><a href="./editProfile.php">プロフィール</a></li>
      <li class="user-menu-list"><i class="user-menu-icon fas fa-cog"></i><a href="">設定</a></li>
      <li class="user-menu-list"><i class="user-menu-icon far fa-question-circle"></i><a href="">ヘルプ</a></li>
      <li class="user-menu-list"><i class="user-menu-icon fas fa-sign-out-alt"></i><a href="./logout.php">ログアウト</a></li>
      <li class="user-menu-list"><i class="user-menu-icon fas fa-user-slash"></i><a href="./delete.php">退会</a></li>
    </ul>
  </div>
  </i>
  <!-- user icon -->
  <div class="account-field__user-icon-wrap">
    <img src="./../images/user_icon.png" alt="ユーザーのアイコン画像" class="account-field__user-icon">
  </div>
  </div>
</div>