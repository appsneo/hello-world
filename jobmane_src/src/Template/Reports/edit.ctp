<?php
  if($report->single):
    $this->assign('title', '単発案件日報編集 | 業務管理システム');
  elseif($mode="add-sigle"):
    $this->assign('title', '日報編集 | 業務管理システム');
  endif;
?>

<?php $this->start('meta'); ?>
<meta name="description" content="日報編集 | 業務管理システム" />
<?php $this->end(); ?>

<?php $this->start('css'); ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/daily_report_edit.css" media="all" />
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="/js/jquery.repeater.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
  $('#a-submit').click(function(){
    $(".form-post").submit();
    //  alert('Sign new href executed.');
    return false;
  });
});
</script>
<?php $this->end(); ?>


<style>
div.inbox .success {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  background-color: #f0f8ff;
  border: solid 1px #0000cd;
  color: #0000cd;
  text-align: left;
  margin-bottom: 12px;
  padding-top: 6px;
  padding-bottom: 6px;
  padding-right: 1px;
  padding-left: 10px;
  list-style-type: none;
  vertical-align: middle;
}
.error {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  background-color: #ffd9d9;
  border: solid 1px #ff3f3f;
  color: #ff3f3f;
  text-align: left;
  margin-bottom: 12px;
  padding-top: 6px;
  padding-bottom: 6px;
  padding-right: 1px;
  padding-left: 10px;
  list-style-type: none;
  vertical-align: middle;
}
.error li:before, .success li:before {
  content: "・";
}
div.inbox .hidden {
  display: none !important;
  position: absolute;;
  width:0 !important:
  height:0;
  padding: 0;
  margin: 0;
  overflow:hidden;;
}

div.material_btn li span {
  color: #fff;
  font-size: 12px;
  background-color: #6f6f6f;
  padding: 10px 20px;
  border-bottom: 2px solid #565656;
  corsor: pointer;
  border-radius: 10px;
  display: inline-block;
  font-size:12px;
  padding:10px 20px;
  cursor:pointer;
}

div.material_btn li span:hover {
    opacity:0.7;
    filter:alpha(opacity=70);
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

<script type="text/javascript">
<!--
  function disp2(id, name, pos){

//alert('disp2(' + id + ',' + name + ',' + pos + ')');

    // 削除確認のdialog
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 260,
      autoOpen: false,
      modal: true,
      position: {
        my: "center top",
        at: "center bottom",
        of: ".remove"
      },
      buttons: {
        " 削除 ": function() {
//            alert('id=' + id);
//            alert('pos=' + pos);
//            alert(            $('.material_ld').index(this));
//alert(            $('.material_id').select().val());
//alert(            $('.material_id').index(pos-1).select().val());
            $('#form-post').attr('action', '/reportMaterials/delete/' + id);
            $('#form-post').submit();
            $( this ).dialog( "close" );
//          $.ajax({
//            type:'POST',
//            url: '/reportMaterials/delete/' + id,
//            success:function(response) {
  //            alert('success');
//              $( this ).dialog( "close" );
              $('div.material:not(:first-child):last-child').remove();

              if(pos==1) {
                  $('.material_id').val('-');
                  $('.quantity').val('0');
                  $('.reportmaterials_id').valu('0');
              }
//            error:function() {
////              alert('error');
    //          $( this ).dialog( "close" );
    //        }
    //      });
      },

//          var form = document.createElement('form');
  //        form.action = '/reportMaterials/delete/' + id;
    //      form.method = 'post';
      //    form.submit();
        //  $( this ).dialog( "close" );
    //    },
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
        $("#delspan").html('「<b>' + name + '</b>」を<br>日報の使用部材から削除しますか？<br>＊この操作は取り消せません＊');
        $(this).siblings('.ui-dialog-buttonpane').find('button:eq(1)').focus();
      }
    });
    $( "#dialog-confirm" ).dialog('open');
  };

  $(document).on('click', '.ui-widget-overlay', function() {
    $(".ui-dialog-titlebar-close").trigger('click');
  })
  // -->
  </script>

<script>
  $(document).ready(function() {

    $("#salaried").change(function(){
  //    alert($("#salaried").attr('checked'));
    //  alert($("#salaried").val());
        if($("#salaried").val() == '有給休暇' && $("#salaried").attr('checked')) {
          $("#hour").val('-');
          $("#hour2").val('-');
          $("#minute").val('-');
          $("#minute2").val('-');
          $(".required").attr('class', 'required hidden');
        } else {
         $("#hour").val('00');
          $("#hour2").val('00');
        $("#minute").val('00');
          $("#minute2").val('00');
        $(".required").attr('class', 'required');
        }
        return false;
      });
    });


</script>

<!--contentns-->
<!--大枠-->
  <section id="body">

    <!--Dialog-->
    <div id="dialog-confirm" title="日報の使用部材削除" style="display:none; background-color:#fff;">
      <p style="padding: 6px 0 0 0;">
         <span id="delspan" style="font-size:14px;"> の使用部材を削除しますか？<br>＊取り消し＊</span></p>
    </div>

  <?php
  if( $from=="add" ) {
    $act = "add";
    $head = "日報編集";
  } elseif( $from=="addSingle" ) {
    $act = "addSingle";
    $head = "日報編集(単発案件)";
  } elseif( $from=="editSingle" ) {
    $act = "editSingle/" . $report->id;
    $head = "日報編集(単発案件)";
  } else {
    $act = "edit/" . $report->id;
    $head = "日報編集";
  }
  ?>
    <form id="form-post" class="form-post" name="form-post" action='/Reports/<?= $act ?>' method='post'>

      <div class="daily_report_edit">
      <div class="inbox">
        <h1><?= $head ?></h1>

        <?= $this->Flash->render() ?>
<?php
        if(isset($errors)):
          $fields = 'time,time2,minute,minute2,note,quantity,allowance,note,remaining';
          echo $this->Consumer->getErrorHtml((isset($errors) ? $errors : ''), $fields, true);
        endif;
 ?>

        <h2 class="company_name"><?= $company->name ?></h2>

        <h3 class="user_name clfx">
          <span class="name">作業員名：<?= $report->user->name ?></span>
        </h3>

        <ul class="outline clfx">
          <li>
            <h4 class="sub_title">作業年月日：</h4>
            <p class="content"><?= $report->work_date_string ?></p>
            <input type="hidden" name="work_date_string" value="<?= $report->work_date_string ?>" />
            <input type="hidden" name="work_date" value="<?= $report->work_date ?>" />
          </li>
          <li>
            <h4 class="sub_title">依頼元：</h4>
        <?php if($from == 'addSingle' || $from=='editSingle'): ?>
            <span class="input"><input type='text' name="client_name" value='<?= $report->client_name ?>' size="24"></span>
        <?php elseif($project->single): ?>
            <p class="content"><?= $project->client_name ?></p>
        <?php else: ?>
            <p class="content"><?php if(isset($project->client->name)){ echo $project->client->name; } ?></p>
        <?php endif; ?>
          </li>
          <li>
            <h4 class="sub_title">工事名：</h4>
        <?php if($from == 'addSingle' || $from=='editSingle'): ?>
            <span class="input"><input type='text' name="project_name" value='<?= $report->project_name ?>' size="24"></span>
        <?php else: ?>
            <p class="content"><?= $project->project_name ?></p>
        <?php endif; ?>
          </li>
          <li>
            <h4 class="sub_title">作業種別：</h4>
        <?php if($from == 'addSingle' || $from=='editSingle'): ?>
            <span class="input"><input type='text' name="category_name" value='<?= $report->category_name ?>' size="24"></span>
        <?php elseif($project->single): ?>
            <p class="content">単発プロジェクト</p>
        <?php else: ?>
            <p class="content"><?php if(isset($project->category->name)) { echo $project->category->name; } ?></p>
        <?php endif; ?>
          </li>
        </ul>

        <!--入場時間、退場時間のデフォルト日時はその会社の所定勤務時間にしてください-->
        <div class="time-check_box">
          <ul class="time">
            <li>
              <span class="required">必須</span>
              入場時間：
              <span class="time">
                <select class="time_select" name="time" id="hour" size="1">
                  <option value="-" selected="selected">-</option>
                  <?php
                    if($report->start_time == null) {
                      $hh = -1;
                    } else {
                      $hh = $report->start_time->format('H');
                    }
                    for ($h=0; $h <= 23; $h++) {
                      $sh = sprintf("%'.02d", $h);
                      if($h == intval($hh)) {
                        print('<option value="' . $sh . '" selected="selected">' . $sh . '</option>');
                      } else {
                        print('<option value="' . $sh . '">' . $sh . '</option>');
                      }
                    } ?>
                </select>
                時
              </span>
              <span class="time">
                <select class="time_select" name="minute" id="minute" size="1">
                  <option value="-" selected="selected">-</option>
                  <?php
                  if($report->start_time == null) {
                    $mm = -1;
                  } else {
                    $mm = $report->start_time->format('i');
                  }
                  for ($m=0; $m <= 50; $m=$m+10) {
                    $sm = sprintf("%'.02d", $m);
                    if($m == intval($mm)) {
                      print('<option value="' . $sm . '" selected="selected">' . $sm . '</option>');
                    } else {
                      print('<option value="' . $sm . '">' . $sm . '</option>');
                    }
                  } ?>
                </select>
                分
              </span>
            </li>
            <li>
              <span class="required">必須</span>
                退場時間：
                <span class="time">
                  <select class="time_select" name="time2" id="hour2" size="1">
                    <option value="-" selected="selected">-</option>
                    <?php
                    if($report->end_time == null) {
                      $hh = -1;
                    } else {
                      $hh = $report->end_time->format('H');
                    }
                    for ($h=0; $h <= 23; $h++) {
                      $sh = sprintf("%'.02d", $h);
                      if($h == intval($hh)) {
                        print('<option value="' . $sh . '" selected="selected">' . $sh . '</option>');
                      } else {
                        print('<option value="' . $sh . '">' . $sh . '</option>');
                      }
                    } ?>
                  </select>
                  時
                </span>
                <span class="time">
                  <select class="time_select" name="minute2" id="minute2" size="1">
                    <option value="-" selected="selected">-</option>
                    <?php
                    if($report->end_time == null) {
                      $mm = -1;
                    } else {
                      $mm = $report->end_time->format('i');
                    }
                    for ($m=0; $m <= 50; $m=$m+10) {
                      $sm = sprintf("%'.02d", $m);
                      if($m == intval($mm)) {
                        print('<option value="' . $sm . '" selected="selected">' . $sm . '</option>');
                      } else {
                        print('<option value="' . $sm . '">' . $sm . '</option>');
                      }
                    } ?>
                  </select>
                  分
                </span>
              </li>
            </ul>

            <div class="detail_check">
              <ul class="check">
                <li><label for="salaried">有給休暇</label><input id="salaried" type="checkbox" name="salaried" value="有給休暇" <?php if($report->salaried){echo 'checked="checked"';} ?>/></li>
                <li><label for="holiday_work">休日出勤</label><input id="holiday_work" type="checkbox" name="holiday_work" value="休日出勤" <?php if($report->holiday_work){echo 'checked="checked"';} ?>/></li>
                <li><label for="other_work">他の仕事あり</label><input id="other_work" type="checkbox" name="other_work" value="他の仕事あり" <?php if($report->other_work){echo 'checked="checked"';} ?>/></li>
              </ul>
            </div>

          </div>

          <div class="material_header clfx">
            <div class="name">使用部材</div>
            <div class="quantity">数量</div>
          </div>

          <div class="repeater">
            <div data-repeater-list="group-a">

            <?php $exist = false;
              if($report->report_materials):
              foreach ($report->report_materials as $reportmaterial):
              // 部材の有無確認
              $exist = true; ?>

              <div class="material clfx" data-repeater-item>
                <div class="name">
                  <select idx="m0001" class="material_id" name="material_id" size="1">
                    <option value="0" selected="selected">------</option>
                    <?php foreach ($materials as $material): ?>
                      <?php if($reportmaterial->material_id == $material->id): ?>
                    <option value="<?= $material->id ?>" selected="selected"><?= $material->name ?></option>
                      <?php else: ?>
                    <option value="<?= $material->id ?>"><?= $material->name ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="quantity">
                  <input idx="q0000" class="reportmaterials_id" type="hidden" name="reportmaterials_id" value="<?= $reportmaterial->id ?>" size="24" />
                  <input idx="q0001" class="quantity" type="text" name="quantity" value="<?= $reportmaterial->quantity ?>" size="24" />
                </div>
              </div>
              <?php endforeach;
            endif; ?>

              <?php if(!$exist): ?>
              <div class="material clfx" data-repeater-item>
                <div class="name">
                  <select idx="m0001" class="material_id" name="material_id" size="1">
                    <option value="0" selected="selected">------</option>
                <?php foreach ($materials as $material): ?>
                    <option value="<?= $material->id ?>"><?= $material->name ?></option>
                <?php endforeach; ?>
                  </select>
                </div>
                <div class="quantity">
                  <input idx="q0000" class="reportmaterials_id" type="hidden" name="reportmaterials_id" value="0" size="24" />
                  <input idx="q0001" class="quantity" type="text" name="quantity" value="0" size="24" />
                </div>
              </div>
              <?php endif; ?>

            </div>
            <div class="material_btn">
              <ul>
                <li><span data-repeater-create>+部材追加</span></li>
                <li><span data-repeater-delete class="remove">×削除</span></li>
              </ul>
            </div>
          </div>

          <h4 class="sub_title2">手当等：</h4>
            <textarea class="text" name="allowance" rows="3" cols="40"><?= $report->allowance ?></textarea>

          <h4 class="sub_title2">備考：</h4>
            <textarea class="text" name="note" rows="3" cols="40"><?= $report->note ?></textarea>

          <h4 class="sub_title2">残工事：</h4>
            <textarea class="text" name="remaining" rows="3" cols="40"><?= $report->remaining ?></textarea>


          <div class="edit_btn">
            <a href="#" id="a-submit">保存する</a>
          </div>

          <div class="completion">
            <span class="check">
              <input id="completion_check" type="checkbox" name="completion_check" value="completion_check" <?php if($report->completion_check){echo 'checked="checked"';} ?>/>
            </span>
            <span class="check_copy"><label for="completion_check">プロジェクトが完工したらチェックをして保存</label></span>
          </div>

        </div>

      </div>

    </section>
  </script>
  <!--大枠-->

  <!--▼ユーザーメニュー-->
  <?= $this->element('slidemenu'); ?>
  <?= $this->element('slidemenu_false') ?>
  <!--▼ユーザーメニュー-->

  <script>
    $(document).ready(function () {

      $('.repeater').repeater({
        defaultValues: {
          'material_id': '0',
          'quantity': '1',
          'reportmaterials_id': '0'
        },
        show: function () {
//          confirm('追加してもよろしいでしょうか？');
          $(this).slideDown();
        },
        hide: function (deleteElement) {
    //          confirm('削除してもよろしいでしょうか？');
          //未使用
          if(confirm('削除してもよろしいでしょうか？')) {
            $(this).slideUp(deleteElement);
          }
        }
      });
    });
  </script>

  <script type="text/javascript">
    (function($){
      $.fn.eventeditor=function(config){
        return this.each(function(i){
          $(this).find('select.material_select');
          $(this).find('input.quantity');
        });
      };

      // execute
      $('div.material').eventeditor();

    })(jQuery);

    /* action eventadd */
    function event_add ()
    {
      // append
      $('div.material:last').clone(true).insertAfter('div.material:last');
    }

    /* action remove */
    $('.remove').on('click', function() {
      var pos = $('.reportmaterials_id').size();
      var m = $('.material_id:last').select().val();
      var m = $('.material_id:last').children(':selected').text();
      var m_id = $('.reportmaterials_id').eq(pos-1).val();
//      alert(m_id);
//      alert(m);
      if(pos == 1 && m_id == 0) {
        $('.material_id').select().val('0');
        $('.quantity').select().val('');
      }
      if(m_id == 0) {
        $('div.material:not(:first-child):last-child').remove();
      } else {
        disp2(m_id, m, pos);
    //    var form = document.createElement('form');
    //    form.action = '/reportMaterials/delete/' + m_id;
    //    form.method = 'post';
      }
    });

  </script>
