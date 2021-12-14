$(function () {

let like = $('#submit');
  like.on('click', function () {
    let comment = $('#comment').val();
    let post_id = $('#post_id').val();
    //ajax処理スタート
      $.ajax({
        headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
        url: 'comment', //通信先アドレスで、このURLをあとでルートで設定します
        method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
        data: { //サーバーに送信するデータ
          'comment': comment,
          'post_id': post_id,
        },
      })
      //通信成功した時の処理
      .done(function (data) {
         console.log(data);
         data.comments.forEach( function( item ) {
          $('#comments').html('<div>'+item.comment+'</div>');
          comment.val('');
         });
      })
      //通信失敗した時の処理
      .fail(function () {
        console.log('fail');
      });
  });
});
