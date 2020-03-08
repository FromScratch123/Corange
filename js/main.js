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
  let signupDrawerTimes = $('.signup-drawer__times');
  let signupDrawer = $('.signup-drawer');
  signupDrawerTimes.click(function () {
    signupDrawer.addClass('js--hidden');
  });
  
});