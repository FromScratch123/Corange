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

  //work-detailsの出現
  let $workImg = $('.work__img');
  let $workTitle = $('.work-title__text');
  let $workDesc = $('.work-description__text');
  let $workDetails = $('.work-details')
  let $windowCover = $('.window-mask');
  $workImg.on('click', function () {
    $workDetails.removeClass('js--hidden');
    $windowCover.removeClass('js--hidden');
  });
  $workTitle.on('click', function () {
    $workDetails.removeClass('js--hidden');
    $windowCover.removeClass('js--hidden');
  });
  $workDesc.on('click', function () {
    $workDetails.removeClass('js--hidden');
    $windowCover.removeClass('js--hidden');
  });

  //workの拡大表示
  let $workLink = $('.work__link');
   $workLink.on('click', function (e) {
    e.preventDefault();
     workId = $(this).data('workId') || null;
     console.log(workId);
      $.ajax({
        type: "GET",
        url: "./../public_html/home.php",
        data: { w : workId},
        context: $(this)
      }).done(function(data, textStatus, jqXHR){
        console.log('Ajaxは成功しました');
      }).fail(function(jqXHR, textStatus, errorThrown){
        return;
      });
 });

});