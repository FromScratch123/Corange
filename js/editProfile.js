$(function () {

  // user-menuの表示
  let $userMenuIcon = $('#user-menu-trigger');
  $userMenuIcon.on("click", function (e) {
    $('.user-menu-box').toggleClass('js--hidden');
    e.stopPropagation(); //clickイベント中断
    $(window).on("click", function () {
      $('.user-menu-box').addClass('js--hidden');
   });
  });

  //user-iconにdragoverした時にcoverの色を変える
  let $userIcon = $('.user-icon__input');
  let $cover = $('.user-icon__cover');
  $userIcon.on("dragover", function (e) {
    e.stopPropagation();
    e.preventDefault();
    $cover.addClass('user-icon__cover--mouseover')
  });
  $userIcon.on("dragleave", function () {
    $cover.removeClass('user-icon__cover--mouseover');
  });
  $userIcon.on('change', function (e) {
    $cover.removeClass('user-icon__cover--mouseover');
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
  


});