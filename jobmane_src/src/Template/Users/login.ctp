
<?php $this->assign('title', 'ログイン | 業務管理システム'); ?>

<?php $this->start('meta'); ?>
<meta name="description" content="ログイン | 業務管理システム" />
<?php $this->end(); ?>

<?php $this->start('css'); ?>
 <link rel="stylesheet" type="text/css" href="/css/manager_user_detail.css" media="all" />
<style>
/* css 追加分を現状ではここに記述中 ... */
/* @エラー時 */
div.login dl.flash{
	width: 80%;
  margin-right: auto;
	margin-left: auto;
	padding-top: 40px;
	padding-bottom: 20px;
  padding-top: 10px;
  padding-bottom: 16px;
}
div.login ul.error{
	background-color: #ffd9d9;
	text-align: left;
  margin-top: 20px;
  margin-bottom: -50px;
	padding-top: 10px;
	padding-right: 10px;
	padding-left: 10px;
	border: solid 1px #ff3f3f;
	list-style-type: none; }
div.login ul.error li{
	color: #ff3f3f;
	font-size: 12px;
	font-weight: bold;
	text-indent: -10px;
	margin-right: 15px;
	margin-bottom: 10px;
	padding-left: 10px;
	display: inline-block;
	*display: inline;
	*zoom: 1;}
div.login ul.error li:before {content:"・";}
div.login ul.error li:last-child{
	margin-right: 0; }
</style>
<?php $this->end(); ?>

<script>
$(document).ready(function() {

//    var val_1 = localStorage.getItem('coco');
  //  alert(val_1);

    //$('#confirmed_id').val(val_1);
//    $('#confirmed_id').text(val_1);
//alert(val_1);
//alert(val_2);

//    if(val_1 == val_2) {
  //      $('#confirmed_result').text(val_1);
//        alert(val_1);
//        alert(val_2);
//    } else {
//        $('#confirmed_result').text("0");
//        alert('NG');
//    }


  // submit !!
  $('#a-submit').click(function(){
    $("#form-post").submit();
    return false;
  });

  // Enter-Keyでログイン
  $(body).keypress(function( event ){
    if(event.which === 13) {
      $("#form-post").submit();
      return false;
    }
    return true;
  });

  // 初期フォーカス設定
  $('#user_id').focus();
  $('#user_id').select();
});
</script>
<?php $this->end(); ?>


<!--▼ヘッダメニュー-->
<?php echo $this->element('header_no'); ?>
<!--▼ユーザーメニュー-->

<!--contentns-->
<!--大枠-->
  <section id="body">
  <form id="form-post" class="form-post" name="form-post" action="/users/login/" method="post">

    <div class="login">

      <?= $this->Flash->render() ?>

      <dl class="flash">
        <?php if(isset($errors)): ?>
          <?php echo $this->Consumer->getErrorHtml((isset($errors) ? $errors : ''), 'user_id,password,auth', true); ?>
        <?php endif; ?>
      </dl>
      <dl class="id">
        <?php if(1==0): ?>
        <dt style="text-align:center;">(2016年 9月23日(金)&nbsp;&nbsp; 7:00 版)</dt><br>
        <?php endif; ?>
        <dt>ID</dt>
        <dd><input type="text" id="user_id" name="user_id" placeholder="IDを入力" size="24" value="<?= $user['user_id'] ?>"/></dd>
      </dl>

      <dl class="password">
        <dt>パスワード</dt>
        <dd><input type="password" name="password" placeholder="パスワードを入力" size="24" value=""/></dd>
      </dl>

      <div class="login_btn">
        <a href="" id="a-submit">ログイン</a>
      </div>

      <input type="hidden" name="confirmed_id" id="confirmed_id" value="<?php if(isset($confirmed_id)){ echo $confirmed_id;} ?>" />
    </div>
  </form>
  </section>
<!--大枠-->
