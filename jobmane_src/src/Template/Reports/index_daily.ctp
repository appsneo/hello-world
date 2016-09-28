<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

<title>日報一覧 | 業務管理システム</title>
<meta name="description" content="日報一覧 | 業務管理システム" />
<meta name="keywords" content="業務管理システム," />
<meta name="author" content="業務管理システム" />

<?php $this->start('css'); ?>
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/daily_report_list.css" media="all" />
<?php $this->end(); ?>

<script src="/js/jquery1.9.1.js" type="text/javascript"></script>
<script src="/js/jquery-migrate-1.2.1.js" type="text/javascript"></script>

<!--[if lt IE 9]>
<script src="/js/html5.js" type="text/javascript"></script>
<script src="/js/selectivizr-min.js" type="text/javascript"></script>
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

    <div class="daily_report_list">
      <div class="inbox">
        <h1>日報一覧</h1>

        <div class="search_box">

          <ul class="pulldown">
            <li>
              <select class="client" name="selectName" size="1">
                <option value="all">すべて</option>
                <option value="client01">積水ハウス岡山支店</option>
                <option value="etc">その他</option>
              </select>
            </li>
            <li>
              <span class="single_work">
                <a href="#">
                  単発案件のみに絞り込む<span class="gray">▼</span>
                </a>
              </span>
            </li>
          </ul>

          <dl class="search">
            <dt><input type="text" name="search" value="" placeholder="日報No、工事物件Noで検索" /></dt>
            <dd><button><span></span></button></dd>
          </dl>

        </div>

        <div class="edit_single_work">
          <a href="/reports/index-single">単発案件作成<img src="/img/common/d-gray_arrow.png" alt="" width="10" /></a>
        </div>

        <ul class="project_list">
          <li>
            <a href="daily_report_list2.html">
              <span class="article_num">工事物件No：XXXXXX</span>
              <h2 class="project_title">プロジェクト名</h2>
            </a>
          </li>
          <li>
            <a href="daily_report_list2.html">
              <span class="article_num">工事物件No：XXXXXX</span>
              <h2 class="project_title">プロジェクト名</h2>
            </a>
          </li>
          <li>
            <a href="daily_report_list2.html">
              <span class="article_num">工事物件No：XXXXXX</span>
              <h2 class="project_title">プロジェクト名</h2>
            </a>
          </li>
        </ul>

    <ul class="pagenation">
      <li class="prev"><a href="../?page=2"><img src="/img/common/c_back.png" alt="前へ" />前へ</a></li>
      <li class="active">1</li>
      <li><a href="../?page=2">2</a></li>
      <li><a href="../?page=3">3</a></li>
      <li><a href="../?page=4">4</a></li>
      <li><a href="../?page=5">5</a></li>
      <li class="next"><a href="../?page=2">次へ<img src="/img/common/c_next.png" alt="次へ" /></a></li>
    </ul>

      </div>
    </div>

  </section>
<!--大枠-->

  <!--▼ユーザーメニュー-->
  <?= $this->element('slidemenu_right'); ?>

</body>

</html>
