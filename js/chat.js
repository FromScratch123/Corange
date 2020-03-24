$(function () {

  //chat-window下部へ移動
  setTimeout(function () {
    let $chatBoxPos = $('.chat-box').last().position();
  $('.chat-window').scrollTop($chatBoxPos.top);
  }, 0);
  
  
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


});