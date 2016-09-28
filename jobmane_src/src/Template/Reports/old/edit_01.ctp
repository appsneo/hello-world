<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

<title>月報編集 | 業務管理システム</title>
<meta name="description" content="月報編集 | 業務管理システム" />
<meta name="keywords" content="業務管理システム," />
<meta name="author" content="業務管理システム" />

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/monthly_report_edit.css" media="all" />
<?php $this->end() ?>

<script src="../js/jquery1.9.1.js" type="text/javascript"></script>
<script src="../js/jquery-migrate-1.2.1.js" type="text/javascript"></script>


<!--[if lt IE 9]>
<script src="../js/html5.js" type="text/javascript"></script>
<script src="../js/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->

<script language="javascript" type="text/javascript">

function swDis() {
fObj = document.salary;
fObj.etc_txt.disabled = (fObj.pay[2].checked) ? false : true ;
}

</script>
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

    <div class="monthly_report_edit">
      <div class="inbox">
        <h1>月報編集</h1>

         <form name="salary">
         <h2 class="client_title">積水ハウス岡山支店</h2>

           <dl class="user">
            <dt>
              <img src="../img/common/default_avatar.png" alt="" width="50" />
            </dt>
            <dd>
            2016/05<br />○○さんの月報
            </dd>
          </dl>

        <h3 class="sub_title">賃金</h3>


          <ul class="radio">
            <li>
              <label for="daily_wage">日給</label><input id="daily_wage" onClick="swDis()" type="radio" name="pay" value="日給" checked="checked">
            </li>
            <li>
              <label for="monthly_salary">月給</label><input id="monthly_salary" onClick="swDis()" type="radio" name="pay" value="月給">
            </li>
            <li>
              <label for="other">その他</label><input id="other" onClick="swDis()" type="radio" name="pay" value="その他">
            </li>
          </ul>

          <h4 class="sub_copy">※「その他」を選んだ場合のみ入力</h4>
          <div class="etc_txt">
            <input class="etc_txt" type="text" name="etc_txt" size="24" disabled="disabled">
          </div>

        <h3 class="sub_title">今月度賞与</h3>

          <ul class="radio">
            <li>
              <label for="bonus_on">有</label><input id="bonus_on" type="radio" name="bonus" value="有">
            </li>
            <li>
              <label for="bonus_off">無</label><input id="bonus_off" type="radio" name="bonus" value="無">
            </li>
          </ul>

          <ul class="time">
            <li>
            <select id="month" class="time" name="month_mm">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6" selected="selected">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            月
            </li>
            <li>
            <select id="day" class="time" name="day_dd">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
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
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30" selected="selected">30</option>
              <option value="31">31</option>
            </select>
            日
            </li>
          </ul>

          <div class="save_btn">
            <a href="#linkURL">保存して一覧へ戻る</a>
          </div>

        </form>

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
            <a href="../project/project_list.html">プロジェクト一覧</a>
          </li>
          <li>
            <a href="../daily_report/daily_report_list.html">日報</a>
          </li>
          <li>
            <a href="monthly_report_list.html">月報</a>
          </li>
        </ul>
        <p class="subtitle">管理者メニュー</p>
        <ul class="menu">
          <li>
            <a href="../manager_user/manager_user_list.html">ユーザー管理</a>
          </li>
          <li>
            <a href="#linkURL">プロジェクト管理</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--▲ユーザーメニュー-->

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
