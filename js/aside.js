$(function () {
  
  let $createBtnL = $('.side-menu__create-btn--large-screen');
  let $createBtnS = $('.side-menu__create-btn--small-screen');
  $createBtnL.on('click', function () {
  //upload-workの出現
    let $uploadBox = $('.upload-work');
    let $windowCover = $('.window-cover');
    $uploadBox.removeClass('js--hidden');
    $windowCover.removeClass('js--hidden');
  });
  $createBtnS.on('click', function () {
    $uploadBox.removeClass('js--hidden');
    $windowCover.removeClass('js--hidden');
  });


  //submitの表示
  let $select = $('.side-menu__category--select');
  let $search = $('.side-menu__search-window');
  $select.on('change', function() {
    let $submit = $('.side-menu__submit');
    $submit.fadeIn(1000);
  });
  $search.on('keyup', function() {
    $submit.fadeIn(1000);
  }); 

  //searchの出現（small-screen)
  let  $searchIcon = $('.categories__list--small-screen');
  $searchIcon.on('click', function(e) {
    let $category = $('.search-by-category');
    let $word = $('.side-menu__search-window--wrap');
    let $searchForm = $('.side-menu__form');
    let $times = $('.search-times');
    let $cover = $('.window-cover');
    $searchForm.addClass('js--show');
    $times.removeClass('js--hidden');
    $category.css('display', 'block');
    $word.css('display', 'block');
    $cover.removeClass('js--hidden');
    $searchForm.fadeIn();
    e.stopPropagation(); //clickイベント中断
    $times.on('click', function() {
      $category.css('display', 'none');
      $word.css('display', 'none');
      $cover.addClass('js--hidden');
      $times.addClass('js--hidden');
      $searchForm.fadeOut();
    });
  });


});