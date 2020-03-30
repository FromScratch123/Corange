$(function () {

   //画面を閉じる
   let $close = $('.close');
   $close.on('click', function () {
    $('.upload-work').addClass('js--hidden');
    $('.window-cover').addClass('js--hidden');
   });

   //work-fileにdragoverした時にcoverの色を変える
   let $workFile = $('.work-file__input');
   let $workFileCover = $('.work-file__cover');
   let $icon = $('.work-file__upload-icon');
   $workFile.on("dragover", function (e) {
     e.stopPropagation();
     e.preventDefault();
     $workFileCover.addClass('work-file__cover--mouseover')
   });
   $workFile.on("dragleave", function () {
     $workFileCover.removeClass('work-file__cover--mouseover');
   });
   $workFile.on('change', function (e) {
       $workFileCover.removeClass('work-file__cover--mouseover');
       $workFileCover.addClass('work-file__cover--selected');
       $icon.removeClass('.fas fa-upload');
       $icon.addClass('far fa-check-circle');
  });

 
     //thumbnailにdragoverした時にcoverの色を変える
   let $thumbnail = $('.thumbnail__input');
   let $thumbnailCover = $('.thumbnail__cover');
   $thumbnail.on("dragover", function (e) {
     e.stopPropagation();
     e.preventDefault();
     $thumbnailCover.addClass('thumbnail__cover--mouseover')
   });
   $thumbnail.on("dragleave", function () {
     $thumbnailCover.removeClass('thumbnail__cover--mouseover');
   });
   $thumbnail.on('change', function (e) {
     $thumbnailCover.removeClass('thumbnail__cover--mouseover');
     //ファイルを取得
     let file = e.target.files[0];
     //imgDOMを取得      
     let $img = $(this).siblings('.thumbnail__img');
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
 


});