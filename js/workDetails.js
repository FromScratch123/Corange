$(function () {

   //画面を閉じる
   let $times = $('.times');
   $times.on('click', function () {
    // $('.work-details').addClass('js--hidden');
    // $('.window-mask').addClass('js--hidden');
    location.href="./home.php";
   });

   //削除選択時にアラート表示
   $('.delete-work__link').on('click', function (e) {
      if (!confirm('Are you sure to delete the work?')) {
         e.preventDefault();
         return false;
      } else {
         return true;
      }
    }); 

  });