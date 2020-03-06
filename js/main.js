$(function () {

  // signup-drawerの消去
  let signupDrawerTimes = $('.signup-drawer__times');
  let signupDrawer = $('.signup-drawer');
  signupDrawerTimes.click(function () {
    signupDrawer.addClass('js-display--none');
  });
  
});