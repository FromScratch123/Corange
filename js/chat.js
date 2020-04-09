$(function () {

  //chat-window下部へ移動
    $(window).on('load', function() {
      let $chatBoxPos = $('.chat-box').last().position();
      let $chatWindow = $('.chat-window');
      $chatWindow.scrollTop($chatBoxPos.top);
    });

  
  // user-menuの表示
  let $userMenuIcon = $('#user-menu-trigger');
  $userMenuIcon.click(function (e) {
    $('.user-menu-box').toggleClass('js--hidden');
    e.stopPropagation(); //clickイベント中断
    $(window).click(function () {
      $('.user-menu-box').addClass('js--hidden');
   });
  });


    //既読の登録
   let $chatTable = $('.chat-table--right') || null;
   let $chatWindow = $('.chat-window');

    $(window).on('load', function () {
        $chatTable.each(function () {
          let targetOffset = $(this).offset();
          let $chatWindowHeight = $chatWindow.height();
          if (targetOffset.top >= $chatWindow.offset().top + $chatWindowHeight / 5) {
            let msgId = $(this).data('messageId') || null;
          $.ajax({
            type: "POST",
            url: "./../public_html/chatRead.php",
            data: { messageId : msgId},
            context: $(this)
          }).done(function(data, textStatus, jqXHR){

          }).fail(function(jqXHR, textStatus, errorThrown){
            return;
          });
        }
        return;
      });
  });
    $chatWindow.on('scroll', function () {
        $chatTable.each(function () {
          let targetOffset = $(this).offset();
          let $chatWindowHeight = $chatWindow.height();
          if (targetOffset.top >= $chatWindow.offset().top + $chatWindowHeight / 5) {
            let msgId = $(this).data('messageId') || null;
          $.ajax({
            type: "POST",
            url: "./../public_html/chatRead.php",
            data: { messageId : msgId},
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

