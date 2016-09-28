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

<script src="../js/jquery1.9.1.js" type="text/javascript"></script>
<script src="../js/jquery-migrate-1.2.1.js" type="text/javascript"></script>

<script src="../js/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="../js/html5.js" type="text/javascript"></script>
<script src="../js/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->

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
  <section id="body">

    <div class="daily_report_edit">
      <div class="inbox">
        <h1>日報編集</h1>

        <h2 class="company_name">(有)岡山テレビ共聴サービス</h2>

        <h3 class="user_name clfx">
          <span class="avatar">
            <img src="../img/common/default_avatar.png" alt="" width="50" />
          </span>
          <span class="name">○○さんの日報</span>
        </h3>

        <ul class="outline clfx">
          <li>
            <h4 class="sub_title">作業年月日：</h4>
            <span class="input">
              <input type="text" name="time" size="24" />
            </span>
          </li>
          <li>
            <h4 class="sub_title">依頼元：</h4>
            <span class="input">
              <input type="text" name="client" size="24" />
            </span>
          </li>
          <li>
            <h4 class="sub_title">工事名：</h4>
            <span class="input">
              <input type="text" name="project_name" size="24" />
            </span>
          </li>
          <li>
            <h4 class="sub_title">作業区分：</h4>
            <span class="input">
              <input type="text" name="category" size="24" />
            </span>
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
          <a href="/reports/indexSingle">保存する</a>
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

  <!--▼ユーザーメニュー-->
  <div class="slidemenu slidemenu-right user_menu">

      <div class="slidemenu-header">
        <div class="user_box">
            <dl class="user clfx">
              <dt class="avatar"><img src="../img/common/default_avatar.png" alt="" width="62" /></dt>
              <dd class="name">
                <span class="name">ユーザー名</span>
                <span class="logout"><a href="#">[ログアウト]</a></span>
              </dd>
            </dl>
        </div>
      </div>

    <div class="slidemenu-body">

      <div class="slidemenu-content">
        <p class="subtitle">目次</p>
        <ul class="menu">
          <li>
            <a href="/projects/index/">プロジェクト一覧</a>
          </li>
          <li>
            <a href="/reports/index/">日報</a>
          </li>
          <li>
            <a href="/reports/index/">月報</a>
          </li>
        </ul>
        <p class="subtitle">管理者メニュー</p>
        <ul class="menu">
          <li>
            <a href="#linkURL">ユーザー管理</a>
          </li>
          <li>
            <a href="#linkURL">プロジェクト管理</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
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

<script type="text/javascript" src="../js/sp-slidemenu.js"></script>
  <script>
    var sp_slidemenu = SpSlidemenu({
      main               : "#body, #header",
      button             : ".menu-button-right",
      slidemenu          : ".slidemenu-right",
      slidemenu_header   : ".slidemenu-header",
      slidemenu_body     : ".slidemenu-body",
      slidemenu_content  : ".slidemenu-content",
      disableCssAnimation: false,
      disable3d          : false,
      direction          : 'right'
    });
</script>
</body>

</html>
