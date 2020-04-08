$(function () {
 
  $('.delete__submit').click(function () {
    if (!confirm('Are you sure to delete your account?')) {
      e.preventDefault();
      return false;
   } else {
      return true;
   }
  }); 
});