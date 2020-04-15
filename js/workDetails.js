$(function () {

   //画面を閉じる
   let $times = $('.times');
   $times.on('click', function () {
    // $('.work-details').addClass('js--hidden');
    // $('.window-mask').addClass('js--hidden');
    if (!document.referrer || document.referrer === document.URL) {
       location.href="./home.php";
    } else {
      location.href=document.referrer;
    }
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