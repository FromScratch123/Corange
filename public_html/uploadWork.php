    <div class="upload-work <?= $upload->hasError() ? '' : 'js--hidden'; ?>">
      <span class="close"><i class="close-icon fas fa-times"></i></span>
      <p class="upload-work__title">Upload new work</p>
      <form class="flex-container upload-work-flex-container" action="" method="post" enctype="multipart/form-data">
        <!-- work file -->
        <div class="work-file-wrap">
        <label for="work-file">
          <div class="work-file">
            <input type="hidden" name="MAX_FILE_SIZE" value="<?= h(MAX_FILE_SIZE) ?>">
            <input class ="work-file__input" type="file" name="work" accept="image/*,audio/*,video/*" >
            <div class="work-file__cover">
            <i class="work-file__upload-icon fas fa-upload"></i>
            </div>
          </div>
          <span class="fz--small">
            work
          </span>
          <p class="has-error margin--0"><?= $upload->getErrors('work-file'); ?></p>
        </label>
        </div>
        <!-- work thumbnail -->
        <div class="work-thumbnail-wrap">
        <label for="thumbnail">
          <div class="thumbnail">
            <input type="hidden" name="MAX_FILE_SIZE" value="<?= h(MAX_FILE_SIZE) ?>">
            <input class ="thumbnail__input" type="file" name="thumbnail" >
            <img class="thumbnail__img" src="<?= isset($upload->getProperties('_myWorks')->work) ? h($upload->getProperties('_myWorks')->work) : './../images/default_work_thumbnail.jpg'; ?>" alt="">
            <div class="thumbnail__cover">
            <i class="thumbnail__camera-icon fas fa-camera"></i>
            </div>
          </div>
          <span class="fz--small">
            thumbnail
          </span>
          <p class="has-error margin--0"><?= $upload->getErrors('thumbnail'); ?></p>
        </label>
        </div>
        <!-- file name -->
        <div class="work-title-wrap">
          <p class="has-error margin--0"><?= $upload->getErrors('empty'); ?></p>
          <p class="has-error margin--0"><?= $upload->getErrors('work-title'); ?></p>
          <label for="work-title">
          <span class="fz--small">
          タイトル: 
          </span>
           <span class="color--red">※</span>
            <p class="margin--0">
              <input type="text" name="title" value="<?= isset($upload->getValues()->title) ? h($upload->getValues()->title) : ''; ?>" placeholder="work title">
            </p>
          </label>
        </div>
          <!-- categories -->
        <div class="categories-wrap">
        <p class="has-error margin--0"><?= $upload->getErrors('categories'); ?></p>
          <label for="categories">
          <span class="fz--small">
          カテゴリー: 
          </span>
          <span class="color--red">※</span>
            <p class="margin--0">
              <select name="category" id="">
                <option value="0">選択してください</option>
                <?php for ($i = 0; isset($upload->getProperties('_categories')->$i); $i++) : ?>
                  <option value="<?= $upload->getProperties('_categories')->$i->id ?>" <?= isset($upload->getValues()->category) && $upload->getValues()->category === $upload->getProperties('_categories')->$i->id ? 'selected' : '' ?>><?= $upload->getProperties('_categories')->$i->name ?></option>
                <?php endfor; ?>
              </select>
            </p>
          </label>
        </div>
          <!-- description -->
          <div class="description-wrap">
            <label>
              <p class="has-error margin--0"><?= $upload->getErrors('description'); ?></p>
              <span class="fz--small">
                説明:
              </span>
              <p class="margin--0">
                <textarea class="work-description__textarea" name="description" id=""><?= isset($upload->getValues()->description) ? h($upload->getValues()->description) : '' ?></textarea>
              </p>
            </label>
          </div>
          <!-- token -->
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
            <input class="work-submit" type="submit" value="SEND">
    </form>
  </div>
  <div class="window-cover <?= $upload->hasError() ? '' : 'js--hidden'; ?>"></div>