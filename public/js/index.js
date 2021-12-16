
//画像表示
$('#myImage').on('change', function (e) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $("#preview").attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
});

//セレクトボックスからの検索をかけれるようにする
$(function() {
    $('.test-select2').select2({
    language: "ja" //日本語化
  });
})
