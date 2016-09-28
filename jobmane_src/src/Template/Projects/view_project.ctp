<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />


<title>プロジェクト別 詳細状況 | 業務管理システム</title>
<meta name="description" content="プロジェクト別 詳細状況 | 業務管理システム" />
<meta name="keywords" content="業務管理システム," />
<meta name="author" content="業務管理システム" />

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/project_table_detail.css" media="all" />
<?php $this->end() ?>

<script src="/js/jquery1.9.1.js" type="text/javascript"></script>
<script src="/js/jquery-migrate-1.2.1.js" type="text/javascript"></script>
<script src="js/table_fixed.js" type="text/javascript"></script>

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

    <div class="project_table_detail">
      <div class="inbox">
        <h1>プロジェクト別 詳細状況</h1>

        <div class="list_btn">
          <a href="/projects/index-projects"><img src="/img/common/gray_arrow_back.png" alt="" width="14" />プロジェクト別一覧へ戻る</a>
        </div>

        <h2 class="title">
          Aアパート
          <span class="progress">進行中</span><!--進行中はclass名：progress未着手はclass名：not_started終了はclass名：endをそれぞれ付与と文言変更-->
        </h2>

        <table class="memo" width="100%">
          <tr>
            <th width="27%">備考(メモ)</th>
            <td>近隣駐車場クレームあり<br />土日作業禁止
            </td>
          </tr>
        </table>

        <table class="work_list tablelock" width="100%">
        <thead>
          <tr>
            <th width="8%">日付</th>
            <th width="68%">作業内容</th>
            <th width="24%">作業者</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td width="8%">2016/06/29</td>
            <td width="68%">アンテナ工事完了</td>
            <td width="24%">吉田</td>
          </tr>
          <tr>
            <td width="8%">2016/06/30</td>
            <td width="68%">仕上げ工事<br />残工事あり</td>
            <td width="24%">三宅</td>
          </tr>
          <tr>
            <td width="8%">2016/07/01</td>
            <td width="68%">仕上げ工事完了</td>
            <td width="24%">河原</td>
          </tr>
          <tr>
            <td width="8%">2016/07/02</td>
            <td width="68%">仕上げ工事完了</td>
            <td width="24%">行森</td>
          </tr>
        </tbody>
        </table>

      </div>
    </div>

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?php echo $this->element('slidemenu'); ?>
<!--▼ユーザーメニュー-->

</body>

</html>
