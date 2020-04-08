$(function () {

  //スムーススクロール
  $('a[href^="#"]').click(function() {
    let speed = 500;
    let adjust = 0;
    let href= $(this).attr("href");
    let target = $(href == "#" || href == "" ? 'html' : href);
    let position = target.offset().top - adjust;
    
    if(target.hasClass("js-hidden")){
        $('body,html').animate({scrollTop:position}, speed, 'swing');
    } else {
        $('body,html').animate({scrollTop:position}, speed, 'swing');
        return false;
    }
 });

  // signup-drawerの消去
  let $signupDrawerTimes = $('.signup-drawer__times');
  let $signupDrawer = $('.signup-drawer');
  $signupDrawerTimes.click(function () {
    $signupDrawer.addClass('js--hidden');
  });

  //setting-menuの出現
  let $setting = $('.user-menu__setting');
  let $settingMenu = $('.setting-menu');
  $($setting).on('mouseover', function() {
    $($settingMenu).removeClass('js--hidden');
  });
  $($settingMenu).on('mouseover', function() {
    $($settingMenu).removeClass('js--hidden');
  });
  $($setting).on('mouseleave', function() {
    $($settingMenu).addClass('js--hidden');
  });

  //messageの削除
  $(window).on('load', function () {
    setTimeout(function() {
      $('.message').fadeOut(1000);
    }, 3000);
    setTimeout(function() {
      $('.message').text("");
    }, 4000);
  });
});