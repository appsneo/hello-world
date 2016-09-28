
<?php $this->assign('title', 'プロジェクト管理 詳細 | 業務管理システム'); ?>

<?php $this->start('meta') ?>
<meta name="description" content="プロジェクト管理 詳細 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/project_calendar.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_project_detail.css" media="all" />
<?php $this->end() ?>

<?php $this->start('script') ?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="/js/jquery-ui-1.10.4.custom.js"></script>
<script src="/js/jquery.ui.datepicker-ja.js"></script>
<script src="/js/jscolor.js"></script>
<script>
$(document).ready(function() {
   $('#a-submit').click(function(){
    $(".form-post").submit();
    return false;
   });
});
</script>
<?php $this->end() ?>

<script>
function disp2(id, name){

//alert(  $('div.material:not(:first-child):last-child').html);
//  $('div.material:not(:first-child):last-child').remove();

//alert(id + " : " + name);

  // 削除確認のdialog
  $( "#dialog-confirm" ).dialog({
    resizable: false,
    height: "auto",
    width: 230,
    autoOpen: true,
    modal: true,
    position: {
      my: "center top",
      at: "center bottom",
      of: "#remove_btn"
    },
    buttons: {
      " 削除 ": function() {

//alert('before.');
//        $.ajax({
  //        url: "/projectPeriods/delete/" + id,
    //      type: "post",
      //    dataType: "html"
        //}).done(function (response) {
  //        alert('success');
    //    }).fail(function () {
      //    alert('failed');
        //});


    //    $('div.material:not(:first-child):last-child').remove();

//        alert('after.');

//        var form = document.createElement('form');
//        form.action = '/projectPeriods/delete/' + id;
//        form.method = 'post';
//        form.submit();

        $('#form-post').attr('action', '/projectPeriods/delete/' + id);
        $('#form-post').submit();

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
      $("#delspan").html('「<b>' + name + '</b>」の<br>作業期間を削除しますか？');
      $(this).siblings('.ui-dialog-buttonpane').find('button:eq(1)').focus();
    }
  });
//    $( "#dialog-confirm" ).dialog('open');
};
// -->
</script>
<style>
div.flash {
  margin-bottom: 12px;
}

div.inbox ul.error, div.inbox ul.success {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  text-align: left;
  margin-bottom: 10px;
  padding-top: 10px;
  padding-bottom: 8px;
  padding-right: 1px;
  padding-left: 10px;
  list-style-type: none;
  vertical-align: middle;
}
div.inbox ul.error {
  padding-bottom: 1px;
}

div.inbox ul.error {
  background-color: #ffd9d9;
  border: solid 1px #ff3f3f;
  color: #ff3f3f;
}

div.inbox ul.success {
  background-color: #f6f6ff;
  border: solid 1px #6f6fff;
  color: #3f3f9f;
}

.error li:before, .success li:before {
  content: "・";
}
.ui-dialog {
  z-index: 1000;
  padding: .2em;
}

/* dialog header */
.ui-widget-header
{
  border:1px solic #dddddd;
  background-color: #45577d;
  background-image: none;
  color: White;
}
.ui-widget-content
{
  border:1px solid #dddddd;
  background-color: #ffffff;
  color: 333333;
}
.ui-dialog .ui-dialog-titlebar {
    paddig: .4em 1em;
    position: relative;
}
.ui-dialog-titlebar {
  text-align: center;
}
.ui-dialog .ui-dialog-content {
  border: 0;
  padding: .5em 1em;
  background: none;
  text-align: center;
  min-height:35px;
}
.ui-dialog .ui-dialog-buttonpane button {
    margin: .5em .8em .5em 0;
    cursor: pointer;
}
.ui-dialog .ui-dialog-buttonpane {
    text-align: left;
    border-width: 1px 0 0 0;
    background-image: none;
    margin-top: .5em;
    padding: .3em 1em .5em .4em;
}
.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset {
    float: right;
}
.ui-widget {
    font-family: Arial, Helvetica,sans-serif;
    font-size: 1em;
}
.ui-button {
    padding: .4em 1em;
    border: 1px solid #c5c5c5;
    background: #f6f6f6;
    font-size: 1em;
}
.ui-corner-all, ui-corner-bottom, .ui-corner-right, .ui-couner-br {
    border-bottom-right-radius: 3px;
}
.ui-corner-all, ui-corner-bottom, .ui-corner-left, .ui-couner-bl {
    border-bottom-left-radius: 3px;
}
.ui-corner-all, ui-corner-bottom, .ui-corner-right, .ui-couner-tr {
    border-top-right-radius: 3px;
}
.ui-corner-all, ui-corner-bottom, .ui-corner-left, .ui-couner-tl {
    border-top-left-radius: 3px;
}
.ui-draggable .ui-dialog-titlebar {
    cursor: move;
}
.ui-dialog .ui-dialog-titlebar {
    padding: .4em 1em;
    position: relative;
}
</style>

<!--contentns-->
<!--大枠-->
<section id="body">
    <form id="form-post" enctype="multipart/form-data"  accept-charset="utf-8" class="form-post" name="form-post" action='<?= $next ?>' method='post'>

    <!--Dialog-->
        <div id="dialog-confirm" title="作業期間の削除" style="display:none; background-color:#fff;">
            <p style="padding: 10px 0 0 0;">
            <span id="delspan" style="font-size:14px;"> のプロジェクト情報を削除しますか？<br>＊取り消し＊</span></p>
        </div>

        <div class="manager_project_detail">
            <div class="inbox">
                <h1>プロジェクト管理 詳細</h1>

                <ul class="error" style="display:none;">
                    <li>工事物件Noは入力必須です edit</li>
            <li>依頼元は入力必須です</li>
            <li>協力会社名は入力必須です</li>
            <li>工事名は入力必須です</li>
            <li>作業種別は入力必須です</li>
            <li>受注金額は入力必須です</li>
            <li>期間は入力必須です</li>
            <li>工事着手日と工事完了日に矛盾があります</li>
            <li>施工場所は入力必須です</li>
            <li>本体工事店建築担当者は入力必須です</li>
            <li>作業員は入力必須です</li>
                    <li>図面書類は入力必須です</li>
                </ul>

          <?= $this->Flash->render() ?>


<?php
    $fields = "num,project_name,client,category,money,start,end,address,charge,operators,document,drawing";
    if(isset($errors)):
      echo $this->Consumer->getErrorHtml($errors, $fields, true);
    endif;
?>

                <input type="hidden" name="company_id" value="<?= $auth['company_id'] ?>"/>

                <h2 class="sub_title">
            工事物件No
                    <span class="required">必須</span>
                </h2>

                <input class="text" type="text" name="num" style="ime-mode: disabled" pattern="^[0-9A-Za-z]+$" size="24" value="<?= $project->num ?>"/>


                <h2 class="sub_title">
            依頼元
                    <span class="required">必須</span>
                </h2>

                <select class="client" name="client_id" size="1">
    <?php foreach ($clients as $client): ?>
                    <option value="<?= $client->id ?>" <?php if($project->client_id == $client->id) {echo 'selected="selected"';} ?>><?= $client->name ?></option>
    <?php endforeach; ?>
                </select>

                <h2 class="sub_title">
            協力会社名(2次業者名)
                </h2>
                <input class="text" type="text" name="secondary" size="24" value="<?= $project->secondary ?>"/>

                <h2 class="sub_title">
            工事名
                <span class="required">必須</span>
                </h2>

                <input class="text" type="text" name="project_name" size="24" value="<?= $project->project_name ?>"/>


                <h2 class="sub_title">
            作業種別
                <span class="required">必須</span>
                </h2>

                <select class="category" name="category_id" size="1">
<?php foreach ($categories as $category): ?>
                <option value="<?= $category->id ?>" <?php if($project->category_id == $category->id) {echo 'selected="selected"';} ?>><?= $category->name ?></option>
<?php endforeach; ?>
                </select>

                <h2 class="sub_title">
            受注金額
                <span class="required">必須</span>
                </h2>

                <div class="money">
  <?php
    $money = $project->money;
    $money = str_replace(",","",$money);
    $money = number_format(intval($money));
  ?>
                    <input class="money js-characters-change" type="text" name="money" size="24" pattern="\d*" value="<?= $money ?>"/>円
                    <span class="inline-block">(半角数字のみ ,カンマもなし)</span>
                </div>

                <h2 class="sub_title2">
            期間指定
                <span class="required">必須</span>
                </h2>

                <div class="repeater">
                    <div class="row">
                        <div class="material" data-repeater-list="group-a">
    <?php
    $pos = 0;
    foreach ($project->project_periods as $period): ?>
                            <div class="period clfx">
                                <div class="start">
                                    <h3 class="sub_title"><img src="/img/common/calendar_pict.png" alt="" width="20" />工事着手日</h3>
                                    <input class="day datepicker date_start" data-date-format="yy/mm/d" type="text" readonly="readonly" name="start[<?= $pos ?>]" size="24" value="<?= $period->start ?>"/>
                                    <input class="projectPeriods_id" type="hidden" readonly="readonly" name="projectPeriods_id[]" value="<?= $period->id ?>"/>
                                </div>
                                <div class="end">
                                    <h3 class="sub_title"><img src="/img/common/calendar_pict.png" alt="" width="20" />工事完了日</h3>
                                    <input class="day datepicker date_end" data-date-format="yy/mm/d" type="text" readonly="readonly" name="end[<?= $pos ?>]" size="24" value="<?= $period->end ?>"/>
                                </div>
                            </div>
    <?php  $pos = $pos + 1;
    endforeach; ?>

    <?php if($pos == 0): ?>
                            <div class="period clfx">
                                <div class="start">
                                    <h3 class="sub_title"><img src="/img/common/calendar_pict.png" alt="" width="20" />工事着手日</h3>
                                    <input class="day datepicker date_start" data-date-format="yy/mm/d"  type="text" readonly="readonly" name="start[0]" size="24" value="<?php $dt = new \DateTime('Now'); echo $dt->format('Y/m/d'); ?>"/>
                                    <input class="projectPeriods_id" type="hidden" readonly="readonly" name="projectPeriods_id[]" value="0"/>
                                </div>
                                <div class="end">
                                    <h3 class="sub_title"><img src="/img/common/calendar_pict.png" alt="" width="20" />工事完了日</h3>
                                    <input class="day datepicker date_end" data-date-format="yy/mm/d"  type="text" readonly="readonly" name="end[0]" size="24" value="<?php $dt = new \DateTime('Now'); echo $dt->format('Y/m/d'); ?>"/>
                                </div>
                            </div>
  <?php endif; ?>

                        </div>
                    </div>
                    <div class="period_btn">
                        <div class="edit_btn">

                            <ul>
                                <li><a href="javascript:event_add();">+期間追加</a></li>
                                <li id="remove_li"><span class="remove" id="remove_btn">×削除</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <h2 class="sub_title">
          プロジェクト期間カラー
                <span class="required">必須</span>
                </h2>
                <input type="text" class="jscolor text" readonlyx="readonly" value="<?= $project->color ?>" name="color" />

                <h2 class="sub_title">
            施工場所
                <span class="required">必須</span>
                </h2>

                <textarea class="text" name="address" rows="4" cols="40"><?php $project->address ?><?= $project->address ?></textarea>

                <h2 class="sub_title">
            概要文
                </h2>

                <textarea class="text" name="summary" rows="4" cols="40"><?php $project->summary ?><?= $project->summary ?></textarea>

                <h2 class="sub_title">
            本体工事店建築担当者
                <span class="required">必須</span>
                </h2>

                <div class="charge">
                    <input class="charge" type="text" name="charge" size="24" value="<?= $project->charge ?>"/>
                </div>

                <h2 class="sub_title">
            作業員指定
                <span class="required">必須</span>
                </h2>

                <ul class="operator_list clfx">

      <?php
          $pos = 0;
          if(count($users) > 0):
            foreach ($users as $user):
              $hit = false;
              if($project->project_users) {
                foreach ($project->project_users as $worker):
                  if( $worker->user_id == $user->id ):
                    $hit = true;
                  endif;
                endforeach;
              }
      ?>
                    <li>
                        <label class="clfx">
                            <dl>
                                <dt><input type="checkbox" name="operators[<?= $pos++ ?>]" value="<?= $user->id ?>"  <?php if($hit) {echo 'checked="checked"'; } ?> /></dt>
                                <dd><?= $user->name ?> さん</dd>
                            </dl>
                        </label>
                    </li>
          <?php endforeach; ?>
        <?php endif; ?>

                </ul>

                <h2 class="sub_title">
          メモ
                </h2>

                <textarea class="text" name="memo" rows="4" cols="40"><?= $project->memo ?></textarea>


                <input type="hidden" name="document" value="<?= $project->document ?>" />
                <h2 class="sub_title2">
      <?php if($project->document): ?>
          図面書類の変更
                <span class="sub_title"> : <?= $project->document ?></span>
      <?php else: ?>
          図面書類を指定
                <span class="required">必須</span>
      <?php endif; ?>
                </h2>

                <div id="select-file">
                    <input type="file"  name="drawing" />
                </div>
                <div class="save_btn">
                    <a href="#" id="a-submit">プロジェクト保存</a>
                </div>

                <div class="completion">
                    <span class="check">
                        <input id="completion_check" type="checkbox" name="completion_check" value="1" <?php if($project->completion_check){echo 'checked="checked"';} ?>/>
                    </span>
                    <span class="check_copy"><label for="completion_check">プロジェクトが完了したらチェックをして保存</label></span>
                </div>
            </div>
        </div>
    </form>
</section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?php echo $this->element('slidemenu'); ?>
<?php echo $this->element('slidemenu_false'); ?>
<!--▼ユーザーメニュー-->

<script>
//  $(document).ready(function() {
$(function(){
//       alert($('#date_start').val());
   if($('.date_start').val() == "" && $('.date_end').val() == "") {
      $('.datepicker').datepicker('setDate', 'today');
   }

});

</script>
<script type="text/javascript">
  (function($){

    $.fn.eventeditor=function(config){

                return this.each(function(i){
      //      alert('date');
//                  $(this).find('input.datepicker').datepicker({'showButtonPanel': true}).datepicker({ dateFormat: "yy/mm/d"});
            //      alert('function * '  + $('.date_start').val());
            //      if($('#date_start').val() == "" && $('#date_end').val() == "") {
                      $(this).find('input.datepicker').datepicker({'showButtonPanel': true}).datepicker({ defaultDate: 'today', dateFormat: "yy/mm/d",});
                //  } else {
  //                  $(this).find('input.datepicker').datepicker({'showButtonPanel': true}).datepicker({ dateFormat: "yy/mm/d"});
                  //}
                });
            };

            // execute
            $('div.period').eventeditor();

            var pos = $('.projectPeriods_id').size();
            //alert(pos);
            if(pos==1){
              // 最低１つの工事期間は必要です
              $('#remove_li').attr('class', 'hidden');
            }




        })(jQuery);


        /* action eventadd
        ================================================================ */
        function event_add ()
        {

          // 削除ボタン再表示
          $('#remove_li').attr('class', '');


            var num = $('.date_start').length;
      //      num = num - 1;
      var snum = 'start[' + num + ']';
      var snum0 = 'start[' + (num-1) + ']';
            var num = $('.date_start').length;
            var str = $('div.period:last').clone().html().replace(snum0, snum);
            snum = 'end[' + num + ']';
            snum0 = 'end[' + (num-1) + ']';
            str = str.replace(snum0, snum);

            str = '<div class="period clfx">' + str + '</div>';

            // append
            $(str).insertAfter('div.period:last');

            $('.projectPeriods_id:last').val("0");
            var now = new Date();
            $mm = "0" + (now.getMonth() + 1);
            $mm = $mm.substr(-2);
            $dd = "0" + now.getDate();
            $dd = $dd.substr(-2);
            $('.date_start:last').val(now.getFullYear() + "/" + $mm + "/" + $dd);
            $('.date_end:last').val(now.getFullYear() + "/" + $mm + "/" + $dd);

          //  alert(  $('div.period:last').clone().html().replace('start[0]',snum) );

          //alert('format');
//                  $(this).find('input.datepicker').datepicker({ dateFormat: "yy/mm/d"});
  //                $(this).find('input.datepicker:last').datepicker({ dateFormat: "yy/mm/d"});
              //    alert('formated' + $('.datepicker'));

            // add event
        	$('div.period:last-child input.datepicker')
        	       .attr("id", "")
        	       .removeClass('hasDatepicker')
//                 .datepicker({'showButtonPanel': true}).datepicker();
                 .datepicker({'showButtonPanel': true}).datepicker({ dateFormat: "yy/mm/d"});
                 //                 .datepicker({'showButtonPanel': true}).datepicker({ dateFormat: "yy/mm/d"});
//                 .datepicker({'showButtonPanel': true}).datepicker({ defaultDate: '11/11/11', dateFormat: "mm/yy/d"});

//                 .datepicker({'showButtonPanel': true}).datepicker({ defaultDate: 'today', dateFormat: "yy/mm/d"});

        }

        /* action remove
        ================================================================ */
        $('.remove').on('click', function() {
      //    alert('remove');

//          $('div.period:not(:first-child):last-child').remove();



          var pos = $('.projectPeriods_id').size();
        //  alert(pos);
          var ms = $('.date_start:last').val();
          var me = $('.date_end:last').val();
          var m_id = $('.projectPeriods_id:last').val();
    //      alert(ms + '〜' + me);
      //    alert('id=' + m_id);
          if(pos==1){
            // 最低１つの工事期間は必要です
            $('#remove_btn').attr('class', 'remove hidden');
//            disp1();
          }
          else if(m_id >  0) {

            disp2(m_id, ms + '〜' + me);

          }
          else if(pos > 1) {
            $('div.period:not(:first-child):last-child').remove();
            if(pos==2){
              // 最低１つの工事期間は必要です
              $('#remove_li').attr('class', 'hidden');
            }
          }
          //          if(pos == 1 && m_id == 0) {
  //  alert(        $('.material_id').select().val() );
    //$('.material_id').select().val('0');
    //$('.quantity').select().val('');
      ////      alert('zannen');
        ////  } else if(pos > 1 && m_id == 0) {
          //}
    //      if(m_id == 0) {
      //      $('div.period:not(:first-child):last-child').remove();
        //  } else {
          //  alert('delete');

      //      disp2(m_id, m);
        //    var form = document.createElement('form');
          //  form.action = '/reportMaterials/delete/' + m_id;
            //form.method = 'post';
    //        //form.submit();

      //    }
    //  //    $('div.material:not(:first-child):last-child').remove();
          ////  $('div.material:last-child').remove();


})

</script>
<script type="text/javascript">
//全角数字を半角に変換
$(function(){
    $(".js-characters-change").blur(function(){
        charactersChange($(this));
    });

    charactersChange = function(ele){
        var val = ele.val();
        var han = val.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){return String.fromCharCode(s.charCodeAt(0)-0xFEE0)});

        if(val.match(/[Ａ-Ｚａ-ｚ０-９]/g)){
            $(ele).val(han);
        }
    }
});
</script>
