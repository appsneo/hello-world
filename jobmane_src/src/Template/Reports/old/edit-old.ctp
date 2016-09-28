<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

<title>日報編集 | 業務管理システム</title>
<meta name="description" content="日報編集 | 業務管理システム" />
<meta name="keywords" content="業務管理システム," />
<meta name="author" content="業務管理システム" />

<?php $this->start('css'); ?>
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/daily_report_edit.css" media="all" />
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="/js/jquery1.9.1.js" type="text/javascript"></script>
<script src="/js/jquery-migrate-1.2.1.js" type="text/javascript"></script>

<script src="/js/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="/js/html5.js" type="text/javascript"></script>
<script src="/js/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->
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

</head>

<body>


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

        <h1>Repeater のデモ。</h1>

        <div action="demo.html" class="repeaterxxxx">
          <div data-repeater-listxxx="group-a">
            <div data-repeater-itemxx>
              <input type="text" name="sei" value="名字"/>
              <input type="text" name="mei" value="名前"/>
              <select name="select-input">
                <option value="男性" selected>男性</option>
                <option value="女性">女性</option>
              </select>
              <input data-repeater-deletexxx type="button" value="削除"/>
            </div>
          </div>
          <input data-repeater-createxxx type="button" value="入力フォームを追加"/>
        </div>


        <script>
        $(document).ready(function () {

          alert('d ready');

          'use strict';
          $('.repeater').repeater({
//            defaultValues: {
  //            'sei': '名字',
    //          'mei': '名前',
      //        'select-input': '女性'
        //    },/
            show: function () {
              $(this).slideDown();
            },
            hide: function (deleteElement) {
              if(confirm('削除してもいーですかー？')) {
                $(this).slideUp(deleteElement);
              }
            }
          });
        });
        </script>




        <!--contentns-->
        <!--大枠-->
          <section id="body">

            <div class="daily_report_edit">
              <div class="inbox">
                <h1>日報編集</h1>

                <h2 class="company_name">(有)岡山テレビ共聴サービス</h2>

                <h3 class="user_name clfx">
                  <span class="avatar">
                    <img src="../img/common/default_avatar.png" alt="" width="50" />
                  </span>
                  <span class="name">作業員名：山田太郎</span>
                </h3>

                <ul class="outline clfx">
                  <li>
                    <h4 class="sub_title">作業年月日：</h4>
                    <p class="content">2016/07/01(金)</p>
                  </li>
                  <li>
                    <h4 class="sub_title">依頼元：</h4>
                    <p class="content">積水ハウス株式会社岡山支店</p>
                  </li>
                  <li>
                    <h4 class="sub_title">工事名：</h4>
                    <p class="content">プロジェクト名</p>
                  </li>
                  <li>
                    <h4 class="sub_title">作業種別：</h4>
                    <p class="content">アンテナ工事</p>
                  </li>
                </ul>

                <!--入場時間、退場時間のデフォルト日時はその会社の所定勤務時間にしてください-->
                <div class="time-check_box">
                  <ul class="time">
                    <li>
                      <span class="required">必須</span>
                      入場時間：
                      <span class="time">
                        <select class="time_select" name="time" size="1">
                          <option value="00">00</option>
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09" selected="selected">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                        </select>
                        時
                      </span>
                      <span class="time">
                        <select class="time_select" name="minute" size="1">
                          <option value="00" selected="selected">00</option>
                          <option value="10">10</option>
                          <option value="20">20</option>
                          <option value="30">30</option>
                          <option value="40">40</option>
                          <option value="50">50</option>
                        </select>
                        分
                      </span>
                    </li>
                    <li>
                      <span class="required">必須</span>
                      退場時間：
                      <span class="time">
                        <select class="time_select" name="time2" size="1">
                          <option value="00">00</option>
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17" selected="selected">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                        </select>
                        時
                      </span>
                      <span class="time">
                        <select class="time_select" name="minute2" size="1">
                          <option value="00">00</option>
                          <option value="10">10</option>
                          <option value="20">20</option>
                          <option value="30" selected="selected">30</option>
                          <option value="40">40</option>
                          <option value="50">50</option>
                        </select>
                        分
                      </span>
                    </li>
                  </ul>

                  <div class="detail_check">
                    <ul class="check">
                      <li><label for="salaried">有給休暇</label><input id="salaried" type="checkbox" name="salaried" value="有給休暇" /></li>
                      <li><label for="holiday_work">休日出勤</label><input id="holiday_work" type="checkbox" name="holiday_work" value="休日出勤" /></li>
                      <li><label for="other_work">他の仕事あり</label><input id="other_work" type="checkbox" name="other_work" value="他の仕事あり" /></li>
                    </ul>
                  </div>

                </div>

                <div class="material_header clfx">
                  <div class="name">使用部材</div>
                  <div class="quantity">数量</div>
                </div>

                <div class="row">
                  <div class="material clfx">
                    <div class="name">
                      <select id="m0001" class="material_select" name="material" size="1">
                        <option value="" selected="selected">------</option>
                        <option value="UHFアンテナ">UHFアンテナ</option>
                        <option value="3 1mmパイプ">3 1mmパイプ</option>
                        <option value="R-100屋根馬">R-100屋根馬</option>
                        <option value="S-5C-FBケーブル">S-5C-FBケーブル</option>
                        <option value="SUS304支線">SUS304支線</option>
                        <option value="BUCB33ブースター">BUCB33ブースター</option>
                      </select>
                    </div>

                    <div class="quantity">
                      <input id="q0001" class="quantity" type="text" name="textfieldName" size="24" />
                    </div>
                  </div>

                </div>

                <div class="material_btn">
                  <ul>
                    <li><a href="javascript:event_add();">+部材追加</a></li>
                    <li><span class="remove">×削除</span></li>
                  </ul>
                </div>

                <h4 class="sub_title2">手当等：</h4>
                <textarea class="text" name="allowance" rows="3" cols="40"></textarea>

                <h4 class="sub_title2">備考：</h4>
                <textarea class="text" name="note" rows="3" cols="40"></textarea>

                <h4 class="sub_title2">残工事：</h4>
                <textarea class="text" name="remaining" rows="3" cols="40"></textarea>


                <div class="edit_btn">
                  <a href="#linkURL">保存する</a>
                </div>

                <div class="completion">
                  <span class="check">
                    <input id="completion_check" type="checkbox" name="completion_check" value="completion_check" />
                  </span>
                  <span class="check_copy"><label for="completion_check">プロジェクトが完工したらチェックをして保存</label></span>
                </div>

              </div>

            </div>

          </section>
        <!--大枠-->



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


                /* action eventadd
                ================================================================ */
                function event_add ()
                {
                    // append
                    $('div.material:last').clone(true).insertAfter('div.material:last');

                    // add event
                	$('div.material:last input.quantity')
                	       .attr("id", "")
                	       .addClass('hasDatepicker')
                	       .datepicker({ defaultDate: 'today', dateFormat: "yy/mm/d"});
                    // add event
                	$('div.material:last select.material_select')
                	       .attr("id", "")
                	       .addClass('hasDatepicker')
                	       .datepicker({ defaultDate: 'today', dateFormat: "yy/mm/d"});

                }

                /* action remove
                ================================================================ */
                $('.remove').on('click', function() {
                  $('div.material:not(:first-child):last-child').remove();
                });
        </script>




  <section id="body">
    <?php if( $mode=="add" ) { $act = "add"; } else { $act = "edit"; } ?>
    <form id="form-post" class="form-post" name="form-post" action='/Reports/<?= $act ?>' method='post'>

    <div class="daily_report_edit">
      <div class="inbox">
        <h1>日報編集 : <?= $report->id ?></h1>

        <h2 class="company_name"><?= $company->name ?></h2>
        <input type="hidden" name="id" value="<?= $company->id ?>" />

        <h3 class="user_name clfx">
          <span class="avatar">
            <img src="/img/common/default_avatar.png" alt="" width="50" />
          </span>
          <span class="name"><?= $user->name ?> さんの日報</span>
        </h3>

        <ul class="outline clfx">
          <li>
            <h4 class="sub_title">作業年月日：</h4>
            <p class="content"><?= $report->work_date_string ?></p>
            <input type="hidden" name="work_date" value="<?= $report->work_date ?>" />
          </li>
          <li>
            <h4 class="sub_title">依頼元：</h4>
            <p class="content"><?= $project->client ?> : 積水ハウス株式会社岡山支店</p>
          </li>
          <li>
            <h4 class="sub_title">工事名：</h4>
            <p class="content"><?= $project->project_name ?> : プロジェクト名</p>
          </li>
          <li>
            <h4 class="sub_title">作業区分：</h4>
            <p class="content"><?= $project->selectName ?> : アンテナ工事</p>
          </li>
        </ul>

        <!--入場時間、退場時間のデフォルト日時はその会社の所定勤務時間にしてください-->
        <div class="time-check_box">
          <ul class="time">
            <li>
              <span class="required">必須</span>
              入場時間：
              <span class="time">
                <select class="time_select" name="time" size="1">
                  <?php
                  if($company->start_time == null) {
                    $hh = -1;
                  } else {
                    $hh = $company->start_time->format('H');
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
                <select class="time_select" name="minute" size="1">
                  <option value="-" selected="selected">-</option>
                  <?php
                  if($company->start_time == null) {
                    $mm = -1;
                  } else {
                    $mm = $company->start_time->format('i');
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
                <select class="time_select" name="time2" size="1">
                  <option value="-" selected="selected">-</option>
                  <?php
                  if($company->end_time == null) {
                    $hh = -1;
                  } else {
                    $hh = $company->end_time->format('H');
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
                <select class="time_select" name="minute2" size="1">
                  <option value="-" selected="selected">-</option>
                  <?php
                  if($company->end_time == null) {
                    $mm = -1;
                  } else {
                    $mm = $company->end_time->format('i');
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
              <li><label for="salaried">有給休暇</label><input id="salaried" type="checkbox" name="salaried" value="1" <?php if($report->salaried == 1) { echo 'checked="checked"'; } ?> /></li>
              <li><label for="holiday_work">休日出勤</label><input id="holiday_work" type="checkbox" name="holiday_work" value="1" <?php if($report->holiday_work == 1) { echo 'checked="checked"'; }; ?>/></li>
              <li><label for="other_work">他の仕事あり</label><input id="other_work" type="checkbox" name="other_work" value="1" <?php if($report->other_work == 1) { echo 'checked="checked"' ;}; ?>/></li>
            </ul>
          </div>

        </div>

        <div class="material_header clfx">
          <div class="name">使用部材</div>
          <div class="quantity">数量</div>
        </div>

        <div class="row repeater">

          <div class="material clfx" data-repeater-list="group-a">

            <div  data-repeater-item>
      <div class="name">
              <select id="m0001" class="material_select" name="material" size="1">
                <option value="" selected="selected">------</option>
          <?php foreach ($materials as $material): ?>
                <option value="<?= $material->id ?>" selected="selected"><?= $material->name ?></option>
          <?php endforeach; ?>
                <option value="UHFアンテナ">UHFアンテナ</option>
                <option value="3 1mmパイプ">3 1mmパイプ</option>
                <option value="R-100屋根馬">R-100屋根馬</option>
                <option value="S-5C-FBケーブル">S-5C-FBケーブル</option>
                <option value="SUS304支線">SUS304支線</option>
                <option value="BUCB33ブースター">BUCB33ブースター</option>
              </select>
        </div>

            <div class="quantity">
          <?php foreach ($materials as $material): ?>
                <input id="q0001" class="quantity" type="text" name="quantity" value="<?= $material->quantity ?>"  size="24" />
                <input id="q0001" class="quantity" type="hidden" name="repmat_id" value="<?= $material->id ?>" size="24" />
                <input id="q0001" class="quantity" type="hidden" name="material_id" value="<?= $material->material_id ?>" size="24" />
          <?php endforeach; ?>
            </div>
          </div>


        </div>







        <div class="material_btn">
          <ul>
            <li><input  data-repeater-create type="button" value="部材追加" /></li>
            <li><input  data-repeater-delete type="button" value="削除" /></li>
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
            <input id="completion_check" type="checkbox" name="completion_check" value="1" <?php if($report->completion_check == 1) { echo 'checked="checked"'; } ?>  />
          </span>
          <span class="check_copy"><label for="completion_check">プロジェクトが完工したらチェックをして保存</label></span>
        </div>

      </div>

    </div>
  </form>
  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu') ?>
<!--▲ユーザーメニュー-->

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


        /* action eventadd
        ================================================================ */
        function event_add ()
        {
            // append
            $('div.material:last').clone(true).insertAfter('div.material:last');

            // add event
        	$('div.material:last input.quantity')
        	       .attr("id", "")
        	       .addClass('hasDatepicker')
        	       .datepicker({ defaultDate: 'today', dateFormat: "yy/mm/d"});
            // add event
        	$('div.material:last select.material_select')
        	       .attr("id", "")
        	       .addClass('hasDatepicker')
        	       .datepicker({ defaultDate: 'today', dateFormat: "yy/mm/d"});

        }

        /* action remove
        ================================================================ */
        $('.remove').on('click', function() {
          $('div.material:not(:first-child):last-child').remove();
        });
</script>
</body>

</html>
