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


    //friend-menuの表示
  let $friendMenuIcon = $('.friend-menu-trigger');
  $friendMenuIcon.click(function (e) {
    let target = $(this).children('.friend-menu-box');
    $('.friend-menu-box').addClass('js--hidden');
    target.toggleClass('js--hidden');
    e.stopPropagation(); //clickイベント中断
    $(window).click(function () {
     target.addClass('js--hidden');
    });
  });

  //notification既読の登録
  let $notificationTable = $('.notification__table') || null;
  let $notificationWindow = $('.notification-window');
   $(window).on('load', function () {
       $notificationTable.each(function () {
         let targetOffset = $(this).offset();
         let $notificationWindowHeight = $notificationWindow.height();
         if (targetOffset.top >= $notificationWindow.offset().top + $notificationWindowHeight / 5) {
           let commentId = $(this).data('commentId') || null;
           let favoriteId = $(this).data('favoriteId') || null;
         $.ajax({
           type: "POST",
           url: "./../public_html/notificationRead.php",
           data: { favorite_id : favoriteId,
                   comment_id : commentId},
           context: $(this)
         }).done(function(data, textStatus, jqXHR){
           console.log('Ajaxは成功しました');
         }).fail(function(jqXHR, textStatus, errorThrown){
           return;
         });
       }
       return;
     });
 });
   $notificationWindow.on('scroll', function () {
       $notificationTable.each(function () {
         let targetOffset = $(this).offset();
         let $notificationWindowHeight = $notificationWindow.height();
         if (targetOffset.top >= $notificationWindow.offset().top + $notificationWindowHeight / 5) {
           let commentId = $(this).data('commentId') || null;
           let favoriteId = $(this).data('favoriteId') || null;
         $.ajax({
           type: "POST",
           url: "./../public_html/notificationRead.php",
           data: { favorite_id : favoriteId,
                   comment_id : commentId},
           context: $(this)
         }).done(function(data, textStatus, jqXHR){
           console.log('Ajaxは成功しました');
         }).fail(function(jqXHR, textStatus, errorThrown){
           return;
         });
       }
       return;
     });
 });

});