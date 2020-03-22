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

    //messageの削除
    setTimeout(function () {
      $('.message').fadeOut(1000);
    }, 2500);

    //friend-menuの表示
  let $friendMenuIcon = $('.friend-menu-trigger');
  $friendMenuIcon.click(function (e) {
    let target = $(this).children('.friend-menu-box');
    target.toggleClass('js--hidden');
    e.stopPropagation(); //clickイベント中断
    $(window).click(function () {
     target.addClass('js--hidden');
    });
  });

});