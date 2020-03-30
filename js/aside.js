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

});