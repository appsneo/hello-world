
<?php $this->assign('title', '目次 | 業務管理システム'); ?>

<?php $this->start('meta'); ?>
<meta name="description" content="目次 | 業務管理システム" />
<?php $this->end(); ?>

<?php $this->start('css'); ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/menu_index.css" media="all" />
<?php $this->end(); ?>

<style>
.success, .error {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  text-align: left;
  margin-bottom: 18px;
  padding-top: 6px;
  padding-bottom: 6px;
  padding-right: 1px;
  padding-left: 10px;
  list-style-type: none;
  vertical-align: middle;
}
.error {
  background-color: #ffd9d9;
  border: solid 1px #ff3f3f;
  color: #ff3f3f;
}
.success {
    background-color: #f0f8ff;
    border: solid 1px #0000cd;
    color: #0000cd;
  }
.error li:before, .success li:before {
  content: "・";
}

div.input ul.error, ul.success,dl.flash ul.success {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  text-align: left;
  margin-top: -10px;
  margin-bottom: 20px;
  padding-top: 6px;
  padding-bottom: 6px;
  padding-right: 1px;
  padding-left: 10px;
  list-style-type: none;
  vertical-align: middle;
}
ul.errorxx {
  background-color: #ffd9d9;
  border: solid 1px #ff3f3f;
  color: #ff3f3f;
}
ul.success, dl.flash ul.success {
    background-color: #f0f8ff;
    border: solid 1px #0000cd;
    color: #0000cd;
}
.error li:before, .error li:before{
  content: "・";
}
</style>



<script>
$(document).ready(function() {

//  alert('menu');

  $('#a_worker').click(function(){
    var action = $("#a_worker").attr('action');
//    alert(action);
    $("#form-menu").attr('action', action);
    $("#form-menu")[0].submit();
    return false;
  });
  $('#a_report').click(function(){
    var action = $("#a_report").attr('action');
//    alert(action);
    $("#form-menu").attr('action', action);
    $("#form-menu")[0].submit();
    return false;
  });
  $('#a_monthly').click(function(){
    var action = $("#a_monthly").attr('action');
//    alert(action);
    $("#form-menu").attr('action', action);
    $("#form-menu")[0].submit();
    return false;
  });
  $('#a_users').click(function(){
    var action = $("#a_users").attr('action');
//    alert(action);
    $("#form-menu").attr('action', action);
    $("#form-menu")[0].submit();
    return false;
  });
  $('#a_projects').click(function(){
    var action = $("#a_projects").attr('action');
//    alert(action);
    $("#form-menu").attr('action', action);
    $("#form-menu")[0].submit();
    return false;
  });
  $('#a_president').click(function(){
    var action = $("#a_president").attr('action');
//    alert(action);
    $("#form-menu").attr('action', action);
    $("#form-menu")[0].submit();
    return false;
  });
  $('#a_materials').click(function(){
    var action = $("#a_materials").attr('action');
//    alert(action);
    $("#form-menu").attr('action', action);
    $("#form-menu")[0].submit();
    return false;
  });
  $('#a_clients').click(function(){
    var action = $("#a_clients").attr('action');
//    alert(action);
    $("#form-menu").attr('action', action);
    $("#form-menu")[0].submit();
    return false;
  });
  $('#a_categories').click(function(){
    var action = $("#a_categories").attr('action');
//    alert(action);
    $("#form-menu").attr('action', action);
    $("#form-menu")[0].submit();
    return false;
  });
  $('#a_presidents').click(function(){
    var action = $("#a_presidents").attr('action');
//    alert(action);
    $("#form-menu").attr('action', action);
    $("#form-menu")[0].submit();
    return false;
  });
  $('#a_menu').click(function(){
    var action = $("#a_menu").attr('action');
//    alert('action');
    $("#form-menu").attr('action', action);
    $("#form-menu")[0].submit();
    return false;
  });
});
</script>


<!--contentns-->
<!--大枠-->
  <section id="body">


    <div class="menu_index">

      <div class="inbox">
        <h1>目次</span></h1>

        <?= $this->Flash->render() ?>

        <form id="form-menu" class="form-menu" name="form-menu" action='' method='post'>
          <input type="hidden" name="urlfrom" value="urlfrom" />
        </form>

<?php if($role == "operator" || $role == "president") { ?>
        <ul class="main_menu">
          <li>
            <a href="" action="/projects/index-worker/" id="a_worker">プロジェクト一覧</a>
          </li>
          <li>
            <a href="" action="/projects/index-report" id="a_report">日報</a>
          </li>
          <li>
            <a href="" action="/reports/index-monthly" id="a_monthly">月報</a>
          </li>
        </ul>
<?php } ?>

<?php if($auth['role'] == 'president') { ?>
        <div class="manager">
          <h2><img src="/img/common/gear_pict.png" alt="" width="20" />管理者メニュー</h2>

          <ul class="manager">
            <li>
              <a href="" action="/users/index" id="a_users">ユーザー管理</a>
            </li>
            <li>
              <a href="" action="/projects/index/" id="a_projects">プロジェクト管理</a>
            </li>
            <li>
              <a href="" action="/users/edit-president/<?= $auth['id'] ?>" id="a_president">管理者・会社情報</a>
            </li>
            <li>
              <a href="" action="/materials/index/<?= $auth['company_id'] ?>" id="a_materials">使用部材</a>
            </li>
            <li>
              <a href="" action="/clients/index/<?= $auth['company_id'] ?>" id="a_clients">取引先</a>
            </li>
            <li>
              <a href="" action="/categories/index/<?= $auth['company_id'] ?>" id="a_categories">作業種別 </a>
            </li>
          </ul>

        </div>
<?php } ?>

<?php if($auth['role'] == 'supervisor') { ?>
        <div class="manager">
          <h2><img src="/img/common/gear_pict.png" alt="" width="20" />スーパーバイザー・メニュー</h2>

          <ul class="manager">
            <li>
              <a href="" action="/users/index-president/<?= $auth['id'] ?>" id="a_presidents">管理者・会社情報</a>
            </li>
          </ul>

        </div>
<?php } ?>

      </div>
    </div>

    <input type="hidden" name="usere_id" id="user_id" value="<?php if(isset($user_id)){ echo $user_id;} ?>" />
    <input type="hidden" name="confirmed_id" id="confirmed_id" value="<?php if(isset($confirmed_id)){ echo $confirmed_id;} ?>" />

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?php echo $this->element('slidemenu'); ?>
<?php echo $this->element('slidemenu_false'); ?>
<!--▼ユーザーメニュー-->
