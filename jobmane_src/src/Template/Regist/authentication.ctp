
<?php $this->assign('title', '端末認証 | 業務管理システム') ?>

<?php $this->start('meta') ?>
<meta name="description" content="端末認証 | 業務管理システム" />
<?php $this->end() ?>

<script>
$(document).ready(function() {

//alert('a');

  $("#go_save").click(function(){
//      alert(":" + $('#go_save').text().trim() + ":");
    if($('#go_save').text().trim() == '認証する') {
//        alert($('#go_save').text());
        $("#form-post").submit();
    }
    return false;
});

//alert('b');

var val_u = $('#user_id').val();
//alert(val_u);
 var val_id = $('#confirm_id').val();
 //alert(val_id);
 if(val_id != "") {


  try {

   localStorage.setItem('coco_' + val_u, val_id);

   var val_ls = localStorage.getItem('coco_' + val_u);
//   alert(val_ls);

   $("#confirmed_id").val(val_ls);

//    alert($('#confirmed_id').text());
//alert(val_2);
 if(val_id == val_ls && val_ls != "") {
   $('#result').text('端末認証できます');
   //$(".form-post").submit();
 } else {
   $('#result').text('端末認証できません');
 }

   } catch (err) {

      //  alert(err);

        $("#confirmed_id").val(val_ls);
        $('#result').text('端末認証できません');
//        alert($('#confirm').html);
//        alert($('#confirm').text);
        $('#confirm').html('端末認証できない設定です');
//        alert($('#confirmed_id').val());
        $('#go_save').attr('class', 'hidden');
   }


 } else {
   $('#result').text('端末認証できません');
     $('#go_save').attr('class', 'hidden');
 }


});

</script>

<!--contentns-->
<!--大枠-->
  <section id="body">

    <form id="form-post" class="form-post" name="form-post" action='/regist/confirmed' method='post'>

    <div class="authentication">
    <div class="inbox">

      <h1 id="result"><?= $result_msg ?></h1>

      <dl class="copy">
        <dt>以下の端末IDを認証</dt>
        <dd id="confirm"><?= $confirm_disp_id ?></dd>
        <input type="hidden" id="confirm_id" name="confirm_id" value="<?= $confirm_id ?>">
        <input type="hidden" id="confirmed_id" name="confirmed_id" value="">
        <input type="hidden" id="user_id" name="user_id" value="<?= $user_id ?>">
      </dl>
<?php if(!$url_error): ?>
      <div class="authentication_btn" id="go_save">
        <a href=""><?= $title_next ?></a>
      </div>
<?php endif; ?>

    </div>
    </div>
  </form>
  </section>
<!--大枠-->
