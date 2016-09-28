<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

<title>完了済　担当一覧 | 業務管理システム</title>
<meta name="description" content="完了済　担当一覧 | 業務管理システム" />
<meta name="keywords" content="業務管理システム," />
<meta name="author" content="業務管理システム" />

<?php $this->start('css'); ?>
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />

<link rel="stylesheet" type="text/css" href="/css/manager_charge_list.css" media="all" />
<?php $this->end() ?>
<script src="../js/jquery1.9.1.js" type="text/javascript"></script>
<script src="../js/jquery-migrate-1.2.1.js" type="text/javascript"></script>

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

    <div class="manager_charge_list">
      <div class="inbox">


         <dl class="user">
          <dt>
            <img src="../img/common/default_avatar.png" alt="" width="50" />
          </dt>
          <dd>
          ○○さんの<br />担当一覧
          </dd>
        </dl>

        <ul class="status_change_btn">
          <li>
            <a href="manager_charge_list.html">一覧</a>
          </li>
          <li class="active">
            <a href="manager_charge_list_completion.html">完了済</a>
          </li>
        </ul>

        <ul class="list">
          <li class="completion">
            <a href="../project/project_detail.html">
              <span class="article_num">工事物件No：XXXXXX</span>
              <h2>プロジェクト名</h2>
            </a>
          </li>
          <li class="completion">
            <a href="../project/project_detail.html">
              <span class="article_num">工事物件No：XXXXXX</span>
              <h2>プロジェクト名</h2>
            </a>
          </li>
          <li class="completion">
            <a href="../project/project_detail.html">
              <span class="article_num">工事物件No：XXXXXX</span>
              <h2>プロジェクト名</h2>
            </a>
          </li>
        </ul>

    <ul class="pagenation">
      <li class="prev"><a href="../?page=2"><img src="../img/common/c_back.png" alt="前へ" />前へ</a></li>
      <li class="active">1</li>
      <li><a href="../?page=2">2</a></li>
      <li><a href="../?page=3">3</a></li>
      <li><a href="../?page=4">4</a></li>
      <li><a href="../?page=5">5</a></li>
      <li class="next"><a href="../?page=2">次へ<img src="../img/common/c_next.png" alt="次へ" /></a></li>
    </ul>

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
            <a href="../monthly_report/monthly_report_list.html">月報</a>
          </li>
        </ul>
        <p class="subtitle">管理者メニュー</p>
        <ul class="menu">
          <li>
            <a href="manager_user_list.html">ユーザー管理</a>
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
