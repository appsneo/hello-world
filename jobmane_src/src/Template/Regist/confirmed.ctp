
<?php $this->assign('title', '端末認証 完了 | 業務管理システム') ?>

<?php $this->start('meta') ?>
<meta name="description" content="端末認証 完了 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<?php $this->end() ?>


<script>
$(document).ready(function() {

//  alert('document ready');

//  $("#go_save").click(function(){
  //  alert($('#confirm_id').text());

  var val_u = $('#user_id').val().trim();
    var val_id = $('#confirmed_id').val().trim();
    var val_ls =  localStorage.getItem('coco_' + val_u);
//    var usr = $('#user_id').text();
//alert(val_u);
//alert(val_id);
//alert(val_ls);

if(val_id == val_ls) {
  //alert('OK');

  //alert('before.');
          $.ajax({
            url: '/confirmed/ok/' + val_ls + '_' + val_u,
            type: "post",
            dataType: "html"
          }).done(function (response) {
    //        alert('success');
          }).fail(function () {
    //        alert('failed');
          });

//  var form = document.createElement('form');
  //form.action = '/confirmed/ok/' + val_1 + '_' + usr;
  //form.method = 'post';
  //form.submit();

}else {
//  alert('NG');
}

  //  if(val_1 == val_2 ) {
    //  $('#result').text('端末認証できました');
//      $(".form-post").submit();
  //  } else {
    //  $('#result').text('認証できませんでした');

//    }
  //  return false;
//  });

});
</script>



<!--contentns-->
<!--大枠-->
  <section id="body">

    <div class="authentication">
    <div class="inbox">

      <h1><?= $result_msg ?></h1>

      <input type="hidden" id="confirmed_id" name="confirmed_id" value="<?= $confirmed_id ?>" size="40"><br>
      <input type="hidden" id="user_id" name="confirmed_id"  value="<?= $user_id ?>" size="40"><br><br>

      <p class="copy">後程、ログイン用の情報をお渡しいたします。</p>

      <p class="copy2">
        <a href="/">⇒ログイン画面はこちら</a>
      </p>

    </div>
    </div>

  </section>
<!--大枠-->
