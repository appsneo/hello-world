
<?php $this->start('meta'); ?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<meta name="description" content="ユーザー管理 一覧 | 業務管理システム" />
<meta name="keywords" content="業務管理システム," />
<meta name="author" content="業務管理システム" />
<?php $this->end(); ?>

<?php $this->start('css'); ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_user_list.css" media="all" />
<?php $this->end(); ?>

<style>
.flash-error {
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

/* The Modal (background) */
.modal {
   display: none; /* Hidden by default */
   position: fixed; /* Stay in place */
   z-index: 1; /* Sit on top */
   left: 0;
   top: 0;
   width: 100%; /* Full width */
   height: 100%; /* Full height */
   overflow: auto; /* Enable scroll if needed */
   background-color: rgb(0,0,0); /* Fallback color */
   background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
   background-color: #fe6e6e;
   margin: 30% auto 30% auto; /* 15% from the top and centered */
   padding: 20px;
   border: 2px solid #888;
   width: 80%; /* Could be more or less, depending on screen size */
   max-width: 400px;
}

/* The Close Button */
.close {
   color: #aaa;
   float: right;
   font-size: 28px;
   font-weight: bold;
}

.close:hover,
.close:focus {
   color: black;
   text-decoration: none;
   cursor: pointer;
}

.ui-widget-header
{
  background-color: #45577d;
  background-image: none;
  color: White;
}
.ui-dialog-buttonset
{
  background-colorxx: #15274d;
  background-image: none;
  color: White;
}
.ui-button.cancelButton {
  border: 1px solid #aaaaaa;
  color:#FF0000;
}
.ui-widget-overlay {
  background: #AAA;
  opacity: .50;
}

</style>

<?php $this->start('script'); ?>
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

	window.alert('最低１人にチェックしてください');

}


  function disp2(id, name){
  //	<a href="#popup" data-rel="popup" data-transition="pop"
//    alert(id + ":" + name);


    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height: "auto",
        width: 400,
        autoOpen: false,
        modal: true,
        position: {
          my: "center top",
          at: "center bottom",
          of: "#del-col" + id
        },
        buttons: {
          " 削除 ": function() {
            $( this ).dialog( "close" );
          },
          "ｷｬﾝｾﾙ": function() {
            $( this ).dialog( "close" );
          }
        },
        showxxx: {
          effect:"blind",
          duration:300
        },
        hide: {
          effect: "blind",
          duration: 500
        },
        open:function(event,ui){
          $(".ui-dialog-titlebar-close").hide();
          $("#delspan").html(name + ' さんのユーザー情報を取り消しますか？<br>＊取り消し＊');
          $(this).siblings('.ui-dialog-buttonpane').find('button:eq(1)').focus();
        }
    });

    $( "#dialog-confirm" ).dialog('open');
  };

  $(document).ready(function() {
/*
    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height: "auto",
        width: 360,
        autoOpen: false,
        modal: true,
        buttons: {
          " 削除 ": function() {
            $( this ).dialog( "close" );
          },
          "ｷｬﾝｾﾙ": function() {
            $( this ).dialog( "close" );
          }
        },
        open:function(event,ui){ $(".ui-dialog-titlebar-close").hide();
        $(this).siblings('.ui-dialog-buttonpane').find('button:eq(1)').focus();
        }
    });
    */
  // Get the modal
//var modal = document.getElementById('myModal');

// Get the button that opens the modal
//var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
$('.myBtn').click( function() {
//  alert('myBtn');
    $('#myModal').attr('style', 'display:block;');
});

// When the user clicks on <span> (x), close the modal
$('.close').click( function() {
  $('#myModal').attr('style', 'display:none;');
//    modal.style.display = "none";
});

$('.cancelmodal').click( function() {
  $('#myModal').attr('style', 'display:none;');
//    modal.style.display = "none";
});
// When the user clicks anywhere outside of the modal, close it
$(document).click( function(event) {
//  alert(event.target);
    //if ($(event.target9.text() != '削除')) {
  //    alert('win-02');
      //$( "#dialog-confirm" ).dialog('close');
//      $('#dialog-confirm').attr('style', 'display:none;');
//        modal.style.display = "none";
    //}
});
});

// -->
</script>

<script type="text/javascript">
<!--

function disp2_old(){

	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if(window.confirm('○○さんのユーザー情報を削除してもよろしいでしょうか？\n※この操作は取り消せません※')){

		window.alert('OKが選択されました');

	}
	// 「OK」時の処理終了

	// 「キャンセル」時の処理開始
	else{

		window.alert('キャンセルされました');

	}
	// 「キャンセル」時の処理終了

}

// -->
</script>

<?php $this->end(); ?>


<!-- header -->
  <header id="header">
    <div class="inbox">

      <ul>
        <li class="back_btn">
          <span onClick="history.back(); return false;">&nbsp;</span>
        </li>
        <li class="menu">
          <span class="menu-button-right">&nbsp;</span>
        </li>
        <li class="logo">
        業務管理システム
        </li>
      </ul>

    </div>
  </header>
<!-- //header -->

<!--contentns-->
<!--大枠-->
  <section id="body">

    <br>
    <br>
    <br>

    <div id="dialog-confirm" title="ユーザー削除" style="display:none; background-color:#fff;">
      <p style="padding: 6px 0 0 0;">
         <span id="delspan" style="font-size:14px;">さんのユーザー情報を削除しますか？<br>＊取り消し＊</span></p>
    </div>


    <!-- Trigger/Open The Modal -->
<button id="myBtn" onclick="abc();">Open Modal</button>

<!-- The Modal -->
<div id="myModal" class="modal" style="display:none;">

 <!-- Modal content -->
 <div class="modal-content">
   <div class="header" >ユーザー削除</div>
   <span class="close">x</span>
   <p>山田 さんのユーザー情報を削除しますか？<br>＊この操作は取り消せません＊</p>
   <div class="footer" >
     <input type="button" value="削除" />
     <input type="button" class="cancelmodal" value="Cancel" />
   </div>
 </div>

</div>

    <br>
    <br>
    <br>

    <?= $this->Html->tag('i','',['class' => 'fa fa-times fa-fw icon-delete deleteUser', 'data-toggle' => 'modal', 'data-target' => '#confirmModal' , 'id' => '99' ]) ?>

    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">Are you sure?</div>
                <div class="modal-footer">
                    <?= $this->Form->postLink(
                        $this->Html->tag('button','Delete',['class' => 'btn btn-default pull-right']),
                        ['action' => 'delete', '99'],
                        ['escape' => false])
                    ?>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- Modal -->
       <div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-sm">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <h4 class="modal-title" id="myModalLabel">Category deletion</h4>
                   </div>
                   <div class="modal-body">
                       Do you  really want  to delete thi element?
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       <a  class="btn btn-danger danger">Confirm</a>
                   </div>
               </div>
           </div>
       </div>

    <div class="manager_user_list">
      <div class="inbox">
        <h1><?php if($from == "indexPresident"){echo '管理者 一覧';}else{ echo '管理者 一覧';} ?>'</h1>

					<div class="flash">
	        	<?= $this->Flash->render() ?>
	      	</div>

          <div class="edit_btn">
            <a href="/users/add/">+新規作成</a>
          </div>

          <div id="mail_btn" class="mail_btn">
             <ul>
              <li class="title">メール：</li>
              <li class="all_btn">
                <span>全員に<img src="/img/manager_uer/all_pict.png" alt="" width="31" /></span>
                <a href=""  "mailto:aaa@aaa.com;bbb@bbb.com;ccc@ccc.com;ddd@ddd.com;eee@eee.com;fff@fff.com">全員に<img src="/img/manager_uer/all_pict.png" alt="" width="31" /></a>
              </li>
              <li class="check_btn">
                <span>チェックした人に<img src="/img/manager_uer/check_pict.png" alt="" width="31" /></span>
              </li>
            </ul>
          </div>

          <div id="show" class="hidden"><p></p></div>

        <ul class="user_list">

	<?php $pos = 1;
    foreach ($users as $user): ?>
          <li class="clfx">
              <div class="avatar">
                <?php if( $user->photo == NULL) { ?>
                  <img id="preview-photo" class="main_img" width="50" altx="preview"  src="/img/common/default_avatar.png" alt="" width="50" />
                <?php } else { ?>
                <img id="preview-photo" class="main_img" width="50" altx="preview" src="/users/contents/<?= $user->id ?>" alt="" width="50" />
                <?php } ?>
              </div>

              <div class="info">
                <span class="name"><span style="color:red;"><?= $user->id . " : " ?></span><?= $user->name ?></span>
                <ul class="btn">
                  <li class="edit">
                    <a href="/users/edit/<?= $user->id ?>">編集</a>
                  </li>
              <?php if($from != "indexPresident"): ?>
                  <li class="browse">
                    <a href="/users/index-project/<?= $user->id ?>">担当</a>
                  </li>
              <?php endif; ?>
                  <li class="delete">
                    <a href="/users/delete/<?= $user->id ?>">削除</a>
                    <span onClick="disp2('<?= $user->id ?>', '<?= $user->name ?>');" id="del-col<?= $user->id ?>">削除</span>
                    <!-- Trigger/Open The Modal -->
                <button class="myBtn" onclick="abc();" value="削除">Open Modal</button>
                  </li>
                  <li class="delete">
                  <?php
                     echo $this->Form->postLink(
                         'Delete',
                         array('action' => 'delete', $user->id),
                         array('confirm' => 'Do you want really to delete thi element?','class' => 'btn btn-danger btn-sm active')
                     );
                     ?>
                   </li>

                  <?= $this->Form->postLink(
                                      $this->Html->tag('button','Delete',['class' => 'btn btn-default pull-right']),
                                      ['action' => 'delete',$user->id],
                                      ['escape' => false])
                                  ?>

<input type='button' class="btn-confirm" value="delete"/>

                </ul>

                <span class="check">
                  <input id="user<?= $pos ?>" type="checkbox" name="user<?= $pos ?>" value="user<?= $pos ?>" />
                  <label for="user<?= $pos ?>" class="hidden"><?= $user->email ?></label>
                </span>
              </div>
          </li>
	<?php $pos++; endforeach; ?>


          <li class="clfx">
              <div class="avatar">
                <img src="/img/common/default_avatar.png" alt="" width="50" />
              </div>
              <div class="info">
                <span class="name">○○さん</span>
                <ul class="btn">
                  <li class="edit">
                    <a href="/users/edit/1">編集</a>
                  </li>
                  <li class="browse">
                    <a href="manager_charge_list.html">担当</a>
                  </li>
                  <li class="delete">
                    <span onClick="disp2('1', 'takao');">削除</span>
                  </li>
                  <?= $this->Form->postLink(
                                      $this->Html->tag('button','Delete',['class' => 'btn btn-default pull-right']),
                                      ['action' => 'delete','105'],
                                      ['escape' => false])
                                  ?>
                </ul>

                <span class="check">
                  <input id="user06" type="checkbox" name="user06" value="user06" />
                  <label for="user06" class="hidden">eee@eee.com</label>
                </span>
              </div>
          </li>
          <li class="clfx">
              <div class="avatar">
                <img src="/img/common/default_avatar.png" alt="" width="50" />
              </div>
              <div class="info">
                <span class="name">○○さん</span>
                <ul class="btn">
                  <li class="edit">
                    <a href="users/edit/1">編集</a>
                  </li>
                  <li class="browse">
                    <a href="manager_charge_list.html">担当</a>
                  </li>
                  <li class="delete">
                    <span onClick="disp2('1', 'ishida');">削除</span>
                  </li>
                </ul>

                <span class="check">
                  <input id="user07" type="checkbox" name="user07" value="user07" />
                  <label for="user07" class="hidden">fff@fff.com</label>
                </span>
              </div>
          </li>
        </ul>

      </div>
    </div>

  </section>
<!--大枠-->

  <!--▼ユーザーメニュー-->
	<?= $this->element('slidemenu') ?>
  <!--▲ユーザーメニュー-->

<script type="text/javascript">
var $c = $('div.manager_user_list input[type="checkbox"]');

$c.bind('change', function(){
var add = '';
$c.each(function(index, value) {
if (this.checked){
//チェックと同時にlabelのfor属性の値をテキストとして表示する
add += ($('label[for="' + this.name + '"]').html() + ';');
alert(add);

}


});

//id="show p"内に挿入
$('#show p').html(add);
});

// 全員にメール
$('li.all_btn a').click(function() {
    var alladdr = '';
    alert('all');
    $c.each(function(index, value) {
        //チェックと同時にlabelのfor属性の値をテキストとして表示する
        alladdr += ($('label[for="' + this.name + '"]').html() + ';');
    });
    location.href = 'mailto:' + alladdr;
    return false;
});


$('li.check_btn span').click(function() {
alert('kita');
  if($('#show p').text() != '') {
    alert('mailto:'+ $('#show p').text());
      location.href = 'mailto:'+ $('#show p').text() ;
      //location.href = 'mailto:aaa@aaa.com;bbb@bbb.com;';
      return false;
  } else {
    disp();
  }
});
</script>


<script type="text/javascript">
//jQuery(function($){
	//$('div#mail_btn').exFlexFixed({
		//container : 'body',
		//fixedHeader : '#header'

	//});
//});
</script>
