<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

<title>プロジェクト　自社の一覧 | 業務管理システム</title>
<meta name="description" content="プロジェクト　自社の一覧 | 業務管理システム" />
<meta name="keywords" content="業務管理システム," />
<meta name="author" content="業務管理システム" />

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/project_list.css" media="all" />
<?php $this->end() ?>


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

    <div class="project_list">
      <div class="inbox">
        <h1>プロジェクト一覧</h1>
        <p class="sub_copy">誰のスケジュールを閲覧しますか？</p>

        <ul class="user_list">
          <li>
            <a href="project_calendar.html">
              <div class="name">
              自社のプロジェクトすべて
              </div>
            </a>
          </li>
          <li>
            <a href="/projects/calendar/1">
              <div class="avatar">
                <img src="/img/common/default_avatar.png" alt="" width="50" />
              </div>
              <div class="name">
              ○○○○○さんのスケジュール一覧
              </div>
            </a>
          </li>
          <li>
            <a href="/projects/calendar/2">
              <div class="avatar">
                <img src="/img/common/default_avatar.png" alt="" width="50" />
              </div>
              <div class="name">
              ○○さんのスケジュール一覧
              </div>
            </a>
          </li>
          <li>
            <a href="/projects/calendar/3">
              <div class="avatar">
                <img src="/img/common/default_avatar.png" alt="" width="50" />
              </div>
              <div class="name">
              ○○さんのスケジュール一覧
              </div>
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
<?= $this->element('slidemenu_right') ?>
<!--▲ユーザーメニュー-->

</body>

</html>
