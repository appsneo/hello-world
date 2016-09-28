
<?php $this->assign('title', 'プロジェクト管理 | 業務管理システム'); ?>

<?php $this->start('meta') ?>
<meta name="description" content="プロジェクト管理 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_project_list.css" media="all" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="/css/coco_pagenation.css" media="all" />
<?php $this->end() ?>

<?php $this->start('script'); ?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script type="text/javascript">
<!--
  function disp2(id, name){
//    alert('del 1');

    // 削除確認のdialog
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 260,
      autoOpen: true,
      modal: true,
      position: {
        my: "left top",
        at: "left bottom",
        of: ".edit_col" + id
      },
      buttons: {
        " 削除 ": function() {
          $('#form-index').attr('action', '/projects/delete/' + id);
          $('#form-index').submit();
          $( this ).dialog( "close" );
        },
        "ｷｬﾝｾﾙ": function() {
          $( this ).dialog( "close" );
          }
        },
        show: {
          effect:"blind",
          duration:300
        },
        hide: {
          effect: "blind",
          duration: 300
        },
        open:function(event,ui){
          $(".ui-dialog-titlebar-close").hide();
          $("#delspan").html('「<b>' + name + '</b>」の<br>プロジェクト情報を削除しますか？<br>＊この操作は取り消せません＊');
          $(this).siblings('.ui-dialog-buttonpane').find('button:eq(1)').focus();
      }
    });
//    $( "#dialog-confirm" ).dialog('open');
  };

$(document).on('click', '.ui-widget-overlay', function() {
  $(".ui-dialog-titlebar-close").trigger('click');
})

// -->
</script>
<?php $this->end(); ?>

<style>
dl.idxxx {
  padding-top: 10px !important;
}
<style>
.errorxxx {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  background-color: #ffd9d9;
  border: solid 1px #ff3f3f;
  color: #ff3f3f;
  text-align: left;
  margin-bottom: -1px;
  padding-top: 6px;
  padding-bottom: 6px;
  padding-right: 1px;
  padding-left: 10px;
  list-style-type: none;
  vertical-align: middle;
}

dl.flash ul.error, dl.flash ul.success, dl.flash ul.error{
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  text-align: left;
  margin-top: -5px;
  margin-bottom: 24px;
  padding-top: 8px;
  padding-bottom: 6px;
  padding-right: 1px;
  padding-left: 10px;
  margin-bottom: 12px;
  list-style-type: none;
  vertical-align: middle;
}
dl.flash ul.error {
  background-color: #ffd9d9;
  border: solid 1px #ff3f3f;
  color: #ff3f3f;
}
dl.flash ul.success, dl.flash ul.error{
  background-color: #f6f6ff;
  border: solid 1px #6f6fff;
  color: #3f3f9f;
}
dl.flash ul.success li:before,dl.flash ul.error li:before {
  content: "・";
}

/* @エラー時 */
div.manager_user_detail ul.error{
	background-color: #ffd9d9;
	text-align: left;
	margin-bottom: 20px;
	padding-top: 12px;
	padding-right: 10px;
	padding-left: 10px;
	border: solid 1px #ff3f3f;
	list-style-type: none; }
dl.flash ul.successsss{
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
div.manager_user_detail ul.error li:before {content:"・";}


.ui-dialog {
  z-index: 1000;
}

/* dialog header */
.ui-widget-header
{
  background-color: #45577d;
  background-image: none;
  color: White;
}
.ui-dialog-titlebar {
  text-align: center;
}
.ui-dialog .ui-dialog-content {
  text-align: center;
  min-height:35px;
}
</style>

<script>
$(document).ready(function() {

    $(document).on("click", "a", function(event) {
       // alert('document on click');

        event.preventDefault();
        var dataUrl = $(this).attr("href");
        if(dataUrl != "") {
            //loadPage(dataUrl);
 
            $("#form-index").attr('action', dataUrl);
            $("#form-index").submit();
       }
    })

    $('aaa').click(function(){
    //    alert('a click()');
    //    alert( $(this).attr('href') );
      action = $(this).attr('href');
      if(action.length > 0 && action != "#") {
    //      alert(action.length);
          $("#form-index").attr('action', action);
          $("#form-index").submit();
      }
      if($action == "#") {
          return true;
      }
      return false;
  });

    $('#a_cal').click(function(){
    var action = $("#a_cal").attr('href');
    //    alert(action);
    $(".form-index").attr('action', action);
    $(".form-index").submit();
    return false;
  });


  $('.time').change(function(){
//       alert('time');
   $(".form-index").attr('action', '/reports');
   $(".form-index").submit();
   return false;
  });
   $('#a_add').click(function(){
     var action = $("#a_add").attr('href');
//     alert(action);
     $(".form-index").attr('action', action);
     $(".form-index").submit();
  //  alert('Sign new href executed.');
    return false;
   });
   $('#a_single').click(function(){
     var action = $("#a_single").attr('href');
//     alert(action);
     $(".form-index").attr('action', action);
     $(".form-index").submit();
  //  alert('Sign new href executed.');
    return false;
   });
   $('#a_cal').click(function(){
     var action = $("#a_cal").attr('href');
  //   alert(action);
     $(".form-index").attr('action', action);
     $(".form-index").submit();
  //  alert('Sign new href executed.');
     return false;
   });
   $('#a_asc').click(function(){
     var action = $("#a_asc").attr('href');
//     alert(action);
     $(".form-index").attr('action', action);
     $(".form-index").submit();
     return false;
   });
   $('#a_desc').click(function(){
     var action = $("#a_desc").attr('href');
//     alert(action);
     $(".form-index").attr('action', action);
     $(".form-index").submit();
     return false;
   });

   $('.a_edit').click(function(){
 //    var action = $(".a_month").attr('action');
     //alert($(".a_month").length);
     var pos = $(".a_edit").index($(this));
     //alert(pos);
     var action = $(".a_edit").get(pos).href; //.attr('class');
 //    alert(elm);
   //s  var action = elm.href; //attr('action');
     //alert(pos);
 //    alert($this);

//     alert(action);
     $(".form-index").attr('action', action);
     $(".form-index").submit();
     return false;
   });


});
</script>


<!--contentns-->
<!--大枠-->
  <section id="body">

		<!--Dialog-->
    <div id="dialog-confirm" title="プロジェクト削除" style="display:none; background-color:#fff;">
      <p style="padding: 6px 0 0 0;">
         <span id="delspan" style="font-size:14px;"> のプロジェクト情報を削除しますか？<br>＊取り消し＊</span></p>
    </div>

  <form id="form-index" class="form-index" name="form-index" action='' method='post'>
    <input type="hidden" name="urlfrom" value="urlfrom" />
  </fomr>

    <div class="manager_project_list">
      <div class="inbox">
        <h1>プロジェクト管理</h1>

      <?= $this->Flash->render() ?>

		<?php
		  $fields = 'name,user_id,password,password_check,email,category,money,start,end,address,charge,select_person,document';
		  if(isset($errors)):
			echo $this->Consumer->getErrorHtml($errors, $fields, true);
		  endif;
		?>

        <ul class="edit_btn">
          <li class="new_project">
            <a href="/projects/add/" id="a_add">+新規作成</a>
          </li>
          <li class="single_project">
            <a href="/projects/add-single/" id="a_single">+単発プロジェクト作成</a>
          </li>
        </ul>

        <div class="row clfx">
          <div class="left_box">
            <ul class="sort clfx">
			        <li class="top" title="金額が低い順に並び替え">
  					    <span><a href="/projects?sort=money&direction=asc" id="a_asc">▲ <br><span>金額が低い順</span></a></span>
                    </li>
				    <li class="down" title="金額が高い順に並び替え">
  					    <span><a class="asc locked" href="/projects?sort=money&direction=desc" id="a_desc">▼ <br><span>金額が高い順</span></a></span>
                    </li>
            </ul>
          </div>

          <div class="right_box">
            <ul class="view_change_btn">
              <li>
                <a href="/projects/calendar-company/" id="a_cal"><img src="/img/common/calendar_pict.png" alt="" width="26" />カレンダー表示</a>
              </li>
            </ul>
          </div>

        </div>

    <!--作業種別カテゴリカラー：　アンテナ工事#ff5c5c 修理#f5b84d CATV工事#6fbd49 放送設備工事#b149bd 無線設備工事#ee913e その他#b8b8b8　単発プロジェクト#666666-->

        <ul class="project_list">
	<?php foreach ($projects as $project): ?>
          <li>
            <div class="project_info" style="border-left-color: #<?= $project->category_color; ?>;"><!--次回フェーズでは作業区分を先方が編集するので（おそらくカラーコードもColorpicker等で指定できるようにするので）、作業区分カラーはコードを直接書くようにします-->

				  <?php
					$money = $project->money;
					$money = str_replace(",","",$money);
					$money = number_format(intval($money));
				  ?>
		  <?php if($project->single): ?>
              <span class="article_num">注文番号 : <?= $project->num ?></span>
			<?php else: ?>
			        <span class="article_num">工事物件No : <?= $project->num ?> - <?= $money ?>円</span>
		  <?php endif; ?>
              <h2><?= $project->project_name ?></h2>
              <ul class="btn">
                <li class="edit">
				  <?php if($project->single): ?>
                  <a href="/projects/edit-single/<?= $project->id ?>" class="a_edit edit_col<?= $project->id ?>">編集</a>
				<?php else: ?>
					        <a href="/projects/edit/<?= $project->id ?>" class="a_edit edit_col<?= $project->id ?>">編集</a>
				<?php endif; ?>
                </li>
                <li class="delete">
                  <span onClick="disp2('<?= $project->id ?>', '<?= $project->project_name ?>');" id="del-col<?= $project->id ?>" class="a_del" >削除</span>
                </li>
              </ul>
              <span class="period"><?= $project->start ?>～<?= $project->end ?></span>
            </div>
          </li>
			<?php endforeach ?>
        </ul>

        <!--▼Pagenation-->
        <?= $this->element('pagenation') ?>
        <!--▲Pagenation-->

      </div>
    </div>

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu'); ?>
<?= $this->element('slidemenu_false') ?>
<!--▼ユーザーメニュー-->
