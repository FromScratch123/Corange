$(function () {
  //upload-workの出現
  let $createBtnL = $('.side-menu__create-btn--large-screen');
  let $createBtnS = $('.side-menu__create-btn--small-screen');
  let $uploadBox = $('.upload-work');
  let $windowCover = $('.window-cover');
  $createBtnL.on('click', function () {
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
  let $submit = $('.side-menu__submit');
  $select.on('change', function() {
    $submit.fadeIn(1000);
  });
  $search.on('keyup', function() {
    $submit.fadeIn(1000);
  }); 
});