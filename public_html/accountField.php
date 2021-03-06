
<div class="account-field">
  <div class="account-field__icons-flex-container flex-container">
  <!-- friend icon -->
  <p class="account-field__icon margin--0">
  <a href="./friendList.php"><i class="icon--black fas fa-user-friends"></i></a>
  </p>
  <!-- chat icon -->
  <p class="account-field__icon margin--0">
  <a href="./chatList.php"><i class="icon--black fas fa-comment-dots"></i></a>
  </p>
  
  <!-- bell icon -->
  <p class="account-field__icon margin--0">
  <a href="notification.php"><i class="icon--black bell-icon fas fa-bell">
  <?php if (isset($notification->getProperties('_notifications')->notification_total) && $notification->getProperties('_notifications')->notification_total > 0) : ?>
  <span class="notification-count"><?= isset($notification->getProperties('_notifications')->notification_total) ? h($notification->getProperties('_notifications')->notification_total) : "" ?></span>
  <?php endif; ?>
  </i></a>
  </p>

  <!-- account menu -->
  <i id="user-menu-trigger" class="user-menu-trigger menu fas fa-ellipsis-h">
  <!-- menu list -->
  <div class="user-menu-box js--hidden">
    <ul>
      <li class="user-menu-list"><i class="user-menu-icon far fa-address-card"></i><a href="./editProfile.php">プロフィール</a></li>
      <li class="user-menu-list user-menu__setting"><i class="user-menu-icon  fas fa-cog"></i><a href="./changPass.php">設定</a>
     <!-- setting drawer -->
      <div class="setting-menu js--hidden">
        <ul>
          <li class="setting-menu-list"><i class="setting-menu-icon fas fa-lock"></i><a href="./changePass.php">パスワード変更</a></li>
          <li class="setting-menu-list"><i class="setting-menu-icon fas fa-user-slash"></i><a href="./delete.php">退会</a></li>
        </ul>
      </div>
      </li>
      <li class="user-menu-list"><i class="user-menu-icon far fa-question-circle"></i><a href="">ヘルプ</a></li>
      <li class="user-menu-list"><i class="user-menu-icon fas fa-sign-out-alt"></i><a href="./logout.php">ログアウト</a></li>
    </ul>
  </div>
  </i>
 
  <!-- user icon -->
  <div class="account-field__user-icon-wrap">
    <img src="<?= isset($app->getProperties('_users')->profile_img) ? h($app->getProperties('_users')->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像" class="account-field__user-icon">
  </div>
  </div>
</div>