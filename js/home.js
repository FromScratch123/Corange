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

    //お気に入り登録
    let $thumbsUp = $('.thumbs-up');
    $thumbsUp.on('click', function () {
      $(this).toggleClass('thumbs-up--true');
      if ($(this).hasClass('thumbs-up--true')) {
        goodNum = $(this).siblings('.good-count').text();
        $(this).siblings('.good-count').text(parseInt(goodNum) + 1);
      } else {
        goodNum = $(this).siblings('.good-count').text();
        $(this).siblings('.good-count').text(parseInt(goodNum) - 1);
      }
      let workId = $(this).data('workId') || null;
      let createUser = $(this).data('createUser') || null;
      $.ajax({
        type: "POST",
        url: "./../public_html/favorite.php",
        data: { work_id : workId,
                create_user : createUser},
        context: $(this)
      }).done(function(data, textStatus, jqXHR){
      }).fail(function(jqXHR, textStatus, errorThrown){
        return;
      });
    });

  //work-detailsの出現
  // let $workImg = $('.work__img');
  // let $workTitle = $('.work-title__text');
  // let $workDesc = $('.work-description__text');
  // let $workDetails = $('.work-details')
  // let $windowCover = $('.window-mask');
  // $workImg.on('click', function () {

  //   $workDetails.removeClass('js--hidden');
  //   $windowCover.removeClass('js--hidden');
  // });
  // $workTitle.on('click', function () {
  //   $workDetails.removeClass('js--hidden');
  //   $windowCover.removeClass('js--hidden');
  // });
  // $workDesc.on('click', function () {
  //   $workDetails.removeClass('js--hidden');
  //   $windowCover.removeClass('js--hidden');
  // });

  //workの拡大表示
  // let $wdImg = $('.work-details__img');
  //  $workImg.on('click', function (e) {
  //    let src = $(this).attr('src');
  //    $wdImg.attr('src', src);

    //  workId = $(this).data('workId') || null;
    //  console.log(workId);
    //   $.ajax({
    //     type: "GET",
    //     url: "./../public_html/home.php",
    //     data: { w : workId},
    //     context: $(this)
    //   }).done(function(data, textStatus, jqXHR){
    //     console.log('Ajaxは成功しました');
    //   }).fail(function(jqXHR, textStatus, errorThrown){
    //     return;
    //   });
//  });

});