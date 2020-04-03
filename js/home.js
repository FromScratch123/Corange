$(function () {

  // user-menuの表示
  let $userMenuIcon = $('#user-menu-trigger');
  $userMenuIcon.click(function (e) {
    $('.user-menu-box').toggleClass('js--hidden');
    e.stopPropagation(); //clickイベント中断
    $(window).click(function () {
      $('.user-menu-box').addClass('js--hidden');
   });
  });

  //ohters-menuの表示
  let $fileMenuIcon = $('.others-menu-trigger');
  $fileMenuIcon.click(function (e) {
    let target = $(this).children('.others-menu-box');
    target.toggleClass('js--hidden');
    e.stopPropagation(); //clickイベント中断
    $(window).click(function () {
     target.addClass('js--hidden');
    });
  });

    //messageの削除
    setTimeout(function () {
      $('.message').fadeOut(1000);
    }, 2500);

   

});