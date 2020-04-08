$(function () {


  //user-iconにdragoverした時にcoverの色を変える
  let $userIcon = $('.user-icon__input');
  let $userCover = $('.user-icon__cover');
  $userIcon.on("dragover", function (e) {
    e.stopPropagation();
    e.preventDefault();
    $userCover.addClass('user-icon__cover--mouseover')
  });
  $userIcon.on("dragleave", function () {
    $userCover.removeClass('user-icon__cover--mouseover');
  });
  $userIcon.on('change', function (e) {
    $submit.fadeIn(1000);
    $userCover.removeClass('user-icon__cover--mouseover');
    //ファイルを取得
    let file = e.target.files[0];
    //imgDOMを取得      
    let $img = $(this).siblings('.user-icon__img');
    //FileReaderのインスタンス作成
    let fileReader = new FileReader();   

    //画像形式ではない場合に表示しない
    if(file.type.indexOf("image") < 0){
      alert("画像ファイルを選択してください。");
      return false;
    }
 
    //選択した画像をimgに設定
    fileReader.onload = function(e) {
      $img.attr('src', e.target.result).show();
    };
    // 6. 画像読み込み
    fileReader.readAsDataURL(file);
  });
  

  ////user-bannerにdragoverした時にcoverの色を変える
  let $userBanner = $('.user-banner__input');
  let $bannerCover = $('.user-banner__cover');
  $userBanner.on("dragover", function (e) {
    e.stopPropagation();
    e.preventDefault();
    $bannerCover.addClass('user-banner__cover--mouseover')
  });
  $userBanner.on("dragleave", function () {
    $bannerCover.removeClass('user-banner__cover--mouseover');
  });

  $userBanner.on('change', function (e) {
    $submit.fadeIn(1000);
    $bannerCover.removeClass('user-banner__cover--mouseover');
    //ファイルを取得
    let file = e.target.files[0];
    //imgDOMを取得      
    let $img = $(this).siblings('.user-banner__img');
    //FileReaderのインスタンス作成
    let fileReader = new FileReader();   

    //画像形式ではない場合に表示しない
    if(file.type.indexOf("image") < 0){
      alert("画像ファイルを選択してください。");
      return false;
    }
 
    //選択した画像をimgに設定
    fileReader.onload = function(e) {
      $img.attr('src', e.target.result).show();
    };
    // 6. 画像読み込み
    fileReader.readAsDataURL(file);
  });

  //submitの表示
  let $slogan = $('.user-slogan__input');
  let $profile = $('.profile-textarea');
  let $sloganCount = $('.slogan-count');
  let $profileCount = $('.profile-count');
  let $sloganLimit = $('.slogan-limit');
  let $profileLimit = $('.profile-limit');
  let $submit = $('.profile-submit');
  $slogan.on('keyup', function() {
    $submit.fadeIn(1000);
    $sloganCount.fadeIn(1000);
    $sloganLimit.fadeIn(1000);
    let count = $(this).val().length;
    $sloganCount.text(count);
  });
  
  $profile.on('keyup', function() {
    $submit.fadeIn(1000);
    $profileCount.fadeIn(1000);
    $profileLimit.fadeIn(1000);
    let count = $(this).val().length;
    $profileCount.text(count);
  });

  //workにホバー時にimgのscaleアップさせる
  let $imgWrap = $('.work-img-wrap');

    $imgWrap.on('mouseover', function() {
      $(this).children('.work__img').css({'transform' : 'scale(1.1, 1.1)', 'transition' : 'transform 0.7s ease-in-out'});
  });
    $imgWrap.on('mouseleave', function() {
      $(this).children('.work__img').css({'transform' : 'scale(1.0, 1.0)', 'transition' : 'transform 0.7s ease'});
    });


});