
  <div class="work-details <?= $work->hasError() ? '' : 'js--hidden'; ?>">
    <span class="times"><i class="close-icon fas fa-times"></i></span>
    <div class="work-details-wrap--flex flex-container">
      <div class="flex-item1">
        <div class="work-details__img-wrap">
          <img src="<?= isset($work->getProperties('_work')->work) ? h($work->getProperties('_work')->work) : './../images/default_work_thumbnail.jpg'; ?>" alt="" class="work-details__img">
        </div>
      </div>
      <div class="flex-item2">
        <!-- title -->
        <p class="work-details__title margin--0">
          <?= isset($work->getProperties('_work')->title) ? h($work->getProperties('_work')->title) : ""; ?>
        </p>
        <!-- category -->
        <p class="work-details__category">
          <?= isset($work->getProperties('_work')->name) ? h($work->getProperties('_work')->name) : ""; ?>
        </p>
        <!-- description -->
        <p class="work-details__description">
          <?= isset($work->getProperties('_work')->description) ? h($work->getProperties('_work')->description) : ""; ?>
        </p>
        <!-- comment -->
        <p class="work-details__comment">
          <?= isset($work->getProperties('_work')->comment) ? h($work->getProperties('_work')->comment) : ""; ?>
        </p>
        <form action="" method="post">
         <textarea name="comment" class="work__textarea" placeholder="leave a comment"></textarea>
         <!-- token -->
         <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
            <input class="work-submit" type="submit" value="work" class="work-submit">
        </form>
      </div>
    </div>
  </div>
        
  <div class="window-mask <?= $work->hasError() ? '' : 'js--hidden'; ?>"></div>