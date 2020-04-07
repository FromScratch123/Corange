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

  //notification既読の登録
  let $notificationTable = $('.notification__table') || null;
  let $notificationWindow = $('.notification-window');
   $(window).on('load scroll', function () {
       $notificationTable.each(function () {
         let targetOffset = $(this).offset();
         let $notificationWindowHight = $notificationWindow.height();
         if (targetOffset.top >= $notificationWindow.scrollTop() + $notificationWindowHight / 5) {
           let commentId = $(this).data('commentId') || null;
           let favoriteId = $(this).data('favoriteId') || null;
         $.ajax({
           type: "POST",
           url: "./../public_html/notificationRead.php",
           data: { favorite_id : favoriteId,
                   comment_id : commentId},
           context: $(this)
         }).done(function(data, textStatus, jqXHR){
         }).fail(function(jqXHR, textStatus, errorThrown){
           return;
         });
       }
       return;
     });
 });

});