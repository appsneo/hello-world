
<?php $this->assign('title', 'ユーザー管理 一覧 | 業務管理システム'); ?>

<?php $this->start('meta'); ?>
<meta name="description" content="ユーザー管理 一覧 | 業務管理システム" />
<?php $this->end(); ?>

<?php $this->start('css'); ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_user_list.css" media="all" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<?php $this->end(); ?>


<style>
ul.error li, ul.success li {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  text-align: left;
  margin-top: 14px;
  margin-bottom: 0px;
  margin-left: -4px;
  padding-top: 8px;
  padding-bottom: 6px;
  padding-right: 1px;
  padding-left: 10px;
  list-style-type: none;
  vertical-align: middle;
}
ul.error li {
  background-color: #ffd9d9;
  border: solid 1px #ff3f3f;
  color: #ff3f3f;
}
ul.success li{
  background-color: #f6f6ff;
  border: solid 1px #6f6fff;
  color: #3f3f9f;
}

ul.error li:before, ul.success li:before {
  content:"・";
}

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

<?php $this->start('script'); ?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="/js/jquery.exflexfixed-0.3.0.js" type="text/javascript"></script>

<script type="text/javascript">
<!--
//jQuery.noConflict();

//(function($) {
  //  $(document).ready(function () {
    //    $(".btn-confirm").on("click", function () {
      //      var action = $(this).attr('data-action');
        //    $("#ConfirmDelete form").attr('action', action);
        //});
    //})
//})(jQuery);

function disp(){

  //	window.alert('最低１人にチェックしてください');
  // メール送信時のチェック確認用dialog
  $( "#dialog-mail" ).dialog({
      resizable: false,
      height: "auto",
      width: 250,
      autoOpen: true,
      modal: true,
      position: {
        my: "center top",
        at: "left bottom",
        of: ".check_btn"
      },
      buttons: {
        "OK": function() {
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
        $(this).siblings('.ui-dialog-buttonpane').find('button:eq(1)').focus();
      }
  });
}


  function disp2(id, role, name){
    // 削除確認のdialog
    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height: "auto",
        width: 240,
        autoOpen: true,
        modal: true,
        position: {
          my: "left top",
          at: "left bottom",
          of: ".edit_col" + id
        },
        buttons: {
          " 削除 ": function() {
            $('#form-index').attr('action', '/users/delete/' + id);
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
          $("#delspan").html('「<b>' + name + '</b>」さんの<br>ユーザー情報を取り消しますか？<br>＊この操作は取り消せません＊');
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


<script>
$(document).ready(function() {

  $('.a_tan').click(function(){
    var pos = $(".a_tan").index($(this));
    //alert(pos);
    var action = $(".a_tan").get(pos).href; //.attr('class');
//    alert(action);
    $(".form-index").attr('action', action);
    $(".form-index").submit();
    return false;
  });

  $('.a_edit').click(function(){
    var pos = $(".a_edit").index($(this));
    var action = $(".a_edit").get(pos).href; //.attr('class');
//    alert(action);
    $(".form-index").attr('action', action);
    $(".form-index").submit();
    return false;
  });

  $('#a_add').click(function(){
    var action = $("#a_add").attr('href');
//    alert(action);
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
    <div id="dialog-confirm" title="ユーザー削除" style="display:none; background-color:#fff;">
      <p style="padding: 6px 0 0 0;">
         <span id="delspan" style="font-size:14px;">さんのユーザー情報を削除しますか？<br>＊取り消し＊</span></p>
    </div>

    <!--Dialog-->
      <div id="dialog-mail" title="チェックした人にメール送信する" style="display:none; padding:12px 0 0 0; background-color:#fff;">
        <p style="padding: 6px 0 0 0;">
           <span style="font-size:14px;">最低一人にチェックしてください</span></p>
      </div>


    <div class="manager_user_list">
      <div class="inbox">
        <h1><?php if($from == "index-president"){echo '管理者 一覧';}else{ echo 'ユーザー管理 一覧';} ?></h1>


          <div class="edit_btn">
      <?php if($from == "index"): ?>
            <a href="/users/add/" id="a_add">+新規作成</a>
      <?php else: ?>
            <a href="/users/add-president/" id="a_add">+新規作成</a>
      <?php endif; ?>
          </div>

          <form id="form-index" class="form-index" name="form-index" action='' method='post'>
            <input type="hidden" name="urlfrom" value="urlfrom" />
          </form>

          <div id="mail_btn" class="mail_btn">
             <ul>
              <li class="title">メール：</li>
              <li class="all_btn">
                <a href="" >全員に<img src="/img/manager_uer/all_pict.png" alt="" width="31" /></a>
              </li>
              <li class="check_btn">
                <span>チェックした人に<img src="/img/manager_uer/check_pict.png" alt="" width="31" /></span>
              </li>
            </ul>
          </div>

          <div id="show" class="hidden"><p></p></div>

          <?= $this->Flash->render() ?>

        <ul class="user_list">

	<?php $pos = 1;
    foreach ($users as $user): ?>
          <li class="clfx">
              <div class="avatar">
                  <img id="preview-photo" class="main_img" altx="preview" src="/users/contents/<?= $user->id ?>" alt="" width="50" />
              </div>

              <div class="info">
                <span class="name"><?= $user->name ?>さん</span>
                <ul class="btn">
                  <li class="edit">
              <?php if($from == "index"): ?>
                <a href="/users/edit/<?= $user->id ?>" class="a_edit edit_col<?= $user->id ?>">編集</a>
              <?php else: ?>
                <a href="/users/edit-president/<?= $user->id ?>" class="a_edit edit_col<?= $user->id ?>">編集</a>
              <?php endif; ?>
                  </li>
              <?php if($from == "index"): ?>
                  <li class="browse">
                    <a href="/users/index-project/<?= $user->id ?>" class="a_tan">担当</a>
                  </li>
              <?php endif; ?>
                  <li class="delete">
                    <span onClick="disp2('<?= $user->id ?>', '<?= $user->role ?>', '<?= $user->name ?>');" id="del-col<?= $user->id ?>">削除</span>
                    <!-- Trigger/Open The Modal -->
                  </li>
                </ul>

                <span class="check">
                  <input id="user<?= $pos ?>" type="checkbox" name="user<?= $pos ?>" value="user<?= $pos ?>" />
                  <label for="user<?= $pos ?>" class="hidden"><?= $user->email ?></label>
                </span>
              </div>
          </li>
	<?php $pos++; endforeach; ?>

        </ul>

      </div>
    </div>

  </section>
<!--大枠-->

  <!--▼ユーザーメニュー-->
	<?= $this->element('slidemenu') ?>
  <?= $this->element('slidemenu_true') ?>
  <!--▲ユーザーメニュー-->

<script type="text/javascript">
var $c = $('div.manager_user_list input[type="checkbox"]');

$c.bind('change', function(){
var add = '';
var buf;
$c.each(function(index, value) {
if (this.checked){
//チェックと同時にlabelのfor属性の値をテキストとして表示する
add += ($('label[for="' + this.name + '"]').html() + ';');
}

});

//id="show p"内に挿入
$('#show p').html(add);
});

// 全員にメール
$('li.all_btn a').click(function() {
    var alladdr = '';
    var buf;
    $c.each(function(index, value) {
        //チェックと同時にlabelのfor属性の値をテキストとして表示する
        alladdr += ($('label[for="' + this.name + '"]').html() + ';');
    });
    location.href = 'mailto:' + alladdr;
    return false;
});

$('li.check_btn span').click(function() {
  if($('#show p').text() != '') {
      location.href = 'mailto:'+ $('#show p').text() ;
      //location.href = 'mailto:aaa@aaa.com;bbb@bbb.com;';
      return false;
  } else {
    disp();
  }
});
</script>

<script type="text/javascript">
  jQuery(function($){
	  $('div#mail_btn').exFlexFixed({
		  container : 'body',
		  fixedHeader : '#header'
	   });
   });
</script>
