
<?php $this->start('meta') ?>
<meta name="description" content="プロジェクト管理 詳細 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->assign('title', 'プロジェクト管理 詳細 | 業務管理システム'); ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_project_detail.css" media="all" />
<?php $this->end() ?>

<?php $this->start('script') ?>
<script src="/js/jquery.ui.datepicker-ja.js"></script>
<script>
$(document).ready(function() {
   $('a[href = "#"]').click(function(){
    $(".form-post").submit();
    alert('Sign new href executed.');
    return false;
   });
});
</script>
<?php $this->end() ?>

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
    <form id="form-post" class="form-post" name="form-post" action='/projects/add' method='post'>
    <div class="manager_project_detail">
      <div class="inbox">
        <h1>プロジェクト管理 詳細</h1>

            <ul class="error">
              <li>工事物件Noは入力必須です</li>
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

        <h2 class="sub_title">
          工事物件No
          <span class="required">必須</span>
        </h2>

        <input class="text" type="text" name="num" style="ime-mode: disabled" pattern="^[0-9A-Za-z]+$" size="24" />


        <h2 class="sub_title">
          依頼元
          <span class="required">必須</span>
        </h2>

        <select class="client" name="selectName" size="1">
          <option value="client01" selected="selected">積水ハウス岡山支店</option>
          <option value="etc">その他</option>
        </select>

        <h2 class="sub_title">
          協力会社名(2次業者名)
        </h2>
        <input class="text" type="text" name="secondary" size="24" />


        <h2 class="sub_title">
          工事名
          <span class="required">必須</span>
        </h2>

        <input class="text" type="text" name="project_name" size="24" />


        <h2 class="sub_title">
          作業種別
          <span class="required">必須</span>
        </h2>

        <select class="category" name="selectName" size="1">
          <option value="antenna" selected="selected">アンテナ工事</option>
          <option value="repair">修理</option>
          <option value="catv">CATV工事</option>
          <option value="broadcast">放送設備工事</option>
          <option value="wireless">無線設備工事</option>
          <option value="etc">その他</option>
        </select>

        <h2 class="sub_title">
          受注金額
          <span class="required">必須</span>
        </h2>

        <div class="money">
          <input class="money js-characters-change" type="text" name="money" size="24" pattern="\d*" />円
          <span class="inline-block">(半角数字のみ ,カンマもなし)</span>
        </div>


        <h2 class="sub_title2">
          期間指定
          <span class="required">必須</span>
        </h2>

        <div class="row">
          <div class="period clfx">
            <div class="start">
              <h3 class="sub_title"><img src="/img/common/calendar_pict.png" alt="" width="20" />工事着手日</h3>
              <input class="day datepicker" type="text" readonly="readonly" name="start" size="24" />
            </div>
            <div class="end">
              <h3 class="sub_title"><img src="/img/common/calendar_pict.png" alt="" width="20" />工事完了日</h3>
              <input class="day datepicker" type="text" readonly="readonly" name="end" size="24" />
            </div>
          </div>
        </div>

        <div class="period_btn">
          <ul>
            <li><a href="javascript:event_add();">+期間追加</a></li>
            <li><span class="remove">×削除</span></li>
          </ul>
        </div>


        <h2 class="sub_title">
          施工場所
          <span class="required">必須</span>
        </h2>

        <textarea class="text" name="address" rows="4" cols="40"></textarea>


        <h2 class="sub_title">
          概要文
        </h2>

        <textarea class="text" name="summary" rows="4" cols="40"></textarea>


        <h2 class="sub_title">
          本体工事店建築担当者
          <span class="required">必須</span>
        </h2>

        <div class="charge">
          <input class="charge" type="text" name="charge" size="24" />
        </div>

        <h2 class="sub_title">
          作業員指定
          <span class="required">必須</span>
        </h2>

        <ul class="operator_list clfx">



        <?php foreach ($users as $user): ?>
          <li>
            <label class="clfx">
              <dl>
                <dt><input type="checkbox" name="<?= $user->name ?>" value="checkboxValue" /></dt>
                <dd>○○さん</dd>
              </dl>
            </label>
          </li>
        <?php endforeach; ?>
          <li>
            <label class="clfx">
              <dl>
                <dt><input type="checkbox" name="◇◇" value="checkboxValue" /></dt>
                <dd>◇◇さん</dd>
              </dl>
            </label>
          </li>

          <li>
            <label class="clfx">
              <dl>
                <dt><input type="checkbox" name="△△" value="checkboxValue" /></dt>
                <dd>△△さん</dd>
              </dl>
            </label>
          </li>

          <li>
            <label class="clfx">
              <dl>
                <dt><input type="checkbox" name="☆☆" value="checkboxValue" /></dt>
                <dd>☆☆さん</dd>
              </dl>
            </label>
          </li>

        </ul>


        <h2 class="sub_title">
          メモ
        </h2>

        <textarea class="text" name="memo" rows="4" cols="40"></textarea>


        <h2 class="sub_title2">
          図面書類を指定
          <span class="required">必須</span>
        </h2>

        <div id="select-file">
          <input type="file" id="select-file" class="file" name="icon" />
        </div>

        <div class="save_btn">
          <a href="#">プロジェクト保存</a>
        </div>

        <div class="completion">
          <span class="check">
            <input id="completion_check" type="checkbox" name="completion_check" value="completion_check" />
          </span>
          <span class="check_copy"><label for="completion_check">プロジェクトが完了したらチェックをして保存</label></span>
        </div>

      </div>
    </div>
  </form>
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
            <a href="../project/project_list.html">プロジェクト一覧</a>
          </li>
          <li>
            <a href="../daily_report/daily_report_list.html">日報</a>
          </li>
          <li>
            <a href="../monthly_report/monthly_report_list.html">月報</a>
          </li>
        </ul>
        <p class="subtitle">管理者メニュー</p>
        <ul class="menu">
          <li>
            <a href="../manager_user/manager_user_list.html">ユーザー管理</a>
          </li>
          <li>
            <a href="manager_project_list.html">プロジェクト管理</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--▲ユーザーメニュー-->

		<!-- jQuery
		======================================================== -->
	<script>
	$(function(){
		$('.datepicker').datepicker('setDate', 'today');
	});
	</script>
        <script type="text/javascript">
        (function($){

            $.fn.eventeditor=function(config){

                return this.each(function(i){

                    $(this).find('input.datepicker').datepicker({'showButtonPanel': true}).datepicker({ defaultDate: 'today', dateFormat: "yy/mm/d",});


                });
            };

            // execute
            $('div.period').eventeditor();

        })(jQuery);


        /* action eventadd
        ================================================================ */
        function event_add ()
        {
            // append
            $('div.period:last').clone(true).insertAfter('div.period:last');


            // add event
        	$('div.period:last input.datepicker')
        	       .attr("id", "")
        	       .removeClass('hasDatepicker')
        	       .datepicker({'showButtonPanel': true}).datepicker({ defaultDate: 'today', dateFormat: "yy/mm/d"});

        }

        /* action remove
        ================================================================ */
        $('.remove').on('click', function() {
          $('div.period:not(:first-child):last-child').remove();
        });
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

<script type="text/javascript" src="/js/sp-slidemenu.js"></script>
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
