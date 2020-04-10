
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\Home();
  $app->run();
  $notification = new MyApp\Controller\accountField();
  $notification->run();
  $work = new MyApp\Controller\WorkDetails();
  $work->run();




  $requestPage = 'HOME -';
  $jsPath1 = './../js/home.js';
  $jsPath2 = './../js/aside.js';
  $jsPath3 = './../js/uploadWork.js';
  $jsPath4 = './../js/workDetails.js';
  $jsPath5 = '';
  $CSSPath1 = './../CSS/home.css';
  $CSSPath2 = './../CSS/accountField.css';
  $CSSPath3 = './../CSS/aside.css';
  $CSSPath4 = './../CSS/uploadWork.css';
  $CSSPath5 = './../CSS/workDetails.css';

  
  require_once(__DIR__ . '/head.php');

  ?>

<body>
<?php 
$logoPath = './home.php';
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/accountField.php');
require_once(__DIR__ . '/aside.php');
 ?>

<!-- message -->
<?php if (!empty($_SESSION['messages']['work-details'])) : ?>
  <div class="message">
    <p class="message__text"><?= !empty($app->getMessage('work-details')) ? h($app->getMessage('work-details')) : "" ?></p>
  </div>
<?php endif; ?>
  
<main>
  <!-- 他者の作品画面 -->
  <?php if (!isset($work->getProperties('_users')->myself)) : ?>
  <div class="work-window">
  <div class="work-details">
    <span class="times"><i class="close-icon fas fa-times"></i></span>
    <div class="work-details-wrap--flex flex-container">
      <div class="flex-item1">
        <div class="work-details__img-wrap">
          <img src="<?= isset($work->getValues()->work) ? h($work->getValues()->work) : './../images/default_work_thumbnail.jpg'; ?>" alt="" class="work-details__img">
        </div>
        <!-- favorite -->
        <p class="work-details__favorite">
        <i class="thumbs-up fas fa-thumbs-up <?= isset($work->getValues()->isFavorite) && $work->getValues()->isFavorite > 0 ? 'thumbs-up--true' : "" ?>" data-work-id="<?= isset($work->getValues()->work_id) ? h($work->getValues()->work_id) : "" ?>" data-create-user="<?= isset($work->getValues()->create_user) ? h($work->getValues()->create_user) : "" ?>"></i>
          <span class="good-count"><?= isset($work->getValues()->favoriteNum) ? h($work->getValues()->favoriteNum) : "" ?></span>
        </p>
      </div>
      <div class="flex-item2">
      <p class="has-error margin--0"><?= $work->getErrors('common'); ?></p>
        <!-- title -->
        <p class="work-details__title margin--0">
          <?= isset($work->getValues()->title) ? h($work->getValues()->title) : ""; ?>
        </p>
        <!-- category -->
        <p class="work-details__category">
          <?= isset($work->getValues()->name) ? h($work->getValues()->name) : ""; ?>
        </p>
        
        <!-- description -->
        <p class="work-details__description">
          <?= isset($work->getValues()->description) ? h($work->getValues()->description) : ""; ?>
        </p>
        <!-- comment -->
        <p class="has-error margin--0"><?= $work->getErrors('empty'); ?></p>
        <div class="work-details__comment">
            <?php for($i = 0; isset($work->getProperties('_comment')->$i); $i++) : ?>
              <table>
                <tbody>
                  <tr>
                    <td>
                      <div class="comment-user-icon-wrap">
                        <a href="./profile.php?u=<?= isset($work->getProperties('_comment')->$i) ? h($work->getProperties('_comment')->$i->id) : "" ?>">
                        <img class="comment-user-icon__img" src="<?= isset($work->getProperties  ('_comment')->$i->profile_img) ? h($work->getProperties('_comment')->$i->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像">
                      </a>
                      </div>
                    </td>
                    <td>
                       <p class="work-details__comment-text">
                       <?= h($work->getProperties('_comment')->$i->comment) ?>
                       </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            <?php endfor; ?>
        </div>
        <form action="" method="post">
         <textarea name="comment" class="work__textarea" placeholder="leave a comment"></textarea>
         <!-- token -->
         <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
            <input class="work-submit" type="submit" value="submit" class="work-submit">
        </form>
      </div>
    </div>
  </div>
        
  <div class="window-mask"></div>

</div>
<?php endif; ?>

<!-- 自身の作品 -->
<?php if (isset($work->getProperties('_users')->myself) && $work->getProperties('_users')->myself == true) : ?>
<div class="work-window">
  <div class="work-details">
    <span class="times"><i class="close-icon fas fa-times"></i></span>
    <div class="work-details-wrap--flex flex-container">
      <div class="flex-item1">
        <div class="work-details__img-wrap">
          <img src="<?= isset($work->getValues()->work) ? h($work->getValues()->work) : './../images/default_work_thumbnail.jpg'; ?>" alt="" class="work-details__img">
        </div>
        <!-- favorite -->
        <p class="work-details__favorite">
        <i class="thumbs-up fas fa-thumbs-up <?= isset($work->getValues()->isFavorite) && $work->getValues()->isFavorite > 0 ? 'thumbs-up--true' : "" ?>" data-work-id="<?= isset($work->getValues()->work_id) ? h($work->getValues()->work_id) : "" ?>" data-create-user="<?= isset($work->getValues()->create_user) ? h($work->getValues()->create_user) : "" ?>"></i>
          <span class="good-count"><?= isset($work->getValues()->favoriteNum) ? h($work->getValues()->favoriteNum) : "" ?></span>
        </p>
      </div>
      <div class="flex-item2">
      <p class="has-error margin--0"><?= $work->getErrors('common'); ?></p>
        <form action="" method="post">
        <!-- title -->
        <p class="work-details__title margin--0">
        <input name="title" type="text" value="<?= isset($work->getValues()->title) ? h($work->getValues()->title) : ""; ?>" class="work-details__title--input">
        </p>
        <!-- category -->
        <label for="categories">
            <p class="work-details__category margin--0">
              <select name="category" id="" class="work-details__category--select">
                <option value="0">選択してください</option>
                <?php for ($i = 0; isset($work->getProperties('_categories')->$i); $i++) : ?>
                  <option value="<?= $work->getProperties('_categories')->$i->id ?>" <?= isset($work->getValues()->category) && $work->getValues()->category === $work->getProperties('_categories')->$i->id ? 'selected' : '' ?>><?= $work->getProperties('_categories')->$i->name ?></option>
                <?php endfor; ?>
              </select>
            </p>
          </label>
        <!-- description -->
        <p class="work-details__description">
          <textarea type="text" name="description" class="work-details__description--input"><?= isset($work->getValues()->description) ? h($work->getValues()->description) : ""; ?></textarea>
        </p>
        <!-- comment -->
        <p class="has-error margin--0"><?= $work->getErrors('empty'); ?></p>
        <div class="work-details__comment">
            <?php for($i = 0; isset($work->getProperties('_comment')->$i); $i++) : ?>
              <table>
                <tbody>
                  <tr>
                    <td class="comment">
                      <div class="comment-user-icon-wrap">
                        <a href="./profile.php?u=<?= isset($work->getProperties('_comment')->$i) ? h($work->getProperties('_comment')->$i->id) : "" ?>">
                        <img class="comment-user-icon__img" src="<?= isset($work->getProperties  ('_comment')->$i->profile_img) ? h($work->getProperties('_comment')->$i->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像">
                      </a>
                      </div>
                    </td>
                    <td>
                       <p class="work-details__comment-text">
                       <?= h($work->getProperties('_comment')->$i->comment) ?>
                       </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            <?php endfor; ?>
        </div>
         <textarea name="comment" class="work__textarea" placeholder="leave a comment"></textarea>
         <!-- token -->
         <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
            <input class="work-submit" type="submit" value="submit" class="work-submit">
        </form>
        <p class="delete-work">
          <a href="./deleteWork.php?w=<?= isset($work->getProperties('_work')->work_id) ? h($work->getProperties('_work')->work_id) : "" ?>" class="delete-work__link">
              作品を削除する
          </a>
        </p>
      </div>
    </div>
  </div>
        
  <div class="window-mask"></div>

</div>
<?php endif; ?>
</main>
</body>
</html>