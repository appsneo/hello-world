<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

<title>プロジェクト管理 | 業務管理システム</title>
<meta name="description" content="プロジェクト管理 | 業務管理システム" />
<meta name="keywords" content="業務管理システム," />
<meta name="author" content="業務管理システム" />

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_project_list.css" media="all" />
<?php $this->end() ?>

<script src="/js/jquery1.9.1.js" type="text/javascript"></script>
<script src="/js/jquery-migrate-1.2.1.js" type="text/javascript"></script>


<!--[if lt IE 9]>
<script src="../js/html5.js" type="text/javascript"></script>
<script src="../js/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->

<script type="text/javascript">
<!--

function disp2(){

	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if(window.confirm('○○○のプロジェクト情報を削除してもよろしいでしょうか？\n※この操作は取り消せません※')){

		window.alert('OKが選択されました');

	}
	// 「OK」時の処理終了

	// 「キャンセル」時の処理開始
	else{

		window.alert('キャンセルされました');

	}
	// 「キャンセル」時の処理終了

}

// -->
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

    <div class="manager_project_list">
      <div class="inbox">
        <h1>プロジェクト管理</h1>

          <ul class="edit_btn">
            <li class="new_project">
              <a href="/projects/add/">+新規作成</a>
            </li>
            <li class="single_project">
              <a href="/projects/add-single/">+単発プロジェクト作成</a>
            </li>
          </ul>

          <div class="row clfx">

            <div class="left_box">
              <ul class="sort clfx">
                <li class="top" title="金額が高い順に並び替え">
                  <a href="#new">▲<span>金額が高い順</span></a>
                </li>
                <li class="down" title="金額が低い順に並び替え">
                  <a href="#old">▼<span>金額が低い順</span></a>
                </li>
              </ul>
            </div>

            <div class="right_box">
              <ul class="view_change_btn">
                <li>
                  <a href="/projects/calendar-company/"><img src="/img/common/calendar_pict.png" alt="" width="26" />カレンダー表示</a>
                </li>
              </ul>
            </div>

          </div>

          <!--作業種別カテゴリカラー：　アンテナ工事#ff5c5c 修理#f5b84d CATV工事#6fbd49 放送設備工事#b149bd 無線設備工事#ee913e その他#b8b8b8　単発プロジェクト#666666-->

          <ul class="project_list">
					<?php foreach ($projects as $project): ?>
            <li>
              <div class="project_info" style="border-left-color: #ff5c5c;"><!--次回フェーズでは作業区分を先方が編集するので（おそらくカラーコードもColorpicker等で指定できるようにするので）、作業区分カラーはコードを直接書くようにします-->
                <span class="article_num"><?= $project->id ?> : <?= $project->num ?></span>
                <h2>プロジェクト名</h2>
                <ul class="btn">
                  <li class="edit">
                    <a href="/projects/edit/<?= $project->id ?>">編集</a>
                  </li>
                  <li class="delete">
                    <span onClick="disp2()">削除</span>
                  </li>
                </ul>
                <span class="period"><?= $project->start ?>～<?= $project->end ?></span>
              </div>
            </li>
					<?php endforeach ?>
            <li>
              <div class="project_info" style="border-left-color: #f5b84d;"><!--次回フェーズでは作業区分を先方が編集するので（おそらくカラーコードもColorpicker等で指定できるようにするので）、作業区分カラーはコードを直接書くようにします-->
                <span class="article_num">工事物件No：XXXXXX</span>
                <h2>プロジェクト名</h2>
                <ul class="btn">
                  <li class="edit">
                    <a href="/projects/edit/">編集</a>
                  </li>
                  <li class="delete">
                    <span onClick="disp2()">削除</span>
                  </li>
                </ul>
                <span class="period">2016/05/01(月)～2016/05/12(月)</span>
              </div>
            </li>
            <li>
              <div class="project_info" style="border-left-color: #6fbd49;"><!--次回フェーズでは作業区分を先方が編集するので（おそらくカラーコードもColorpicker等で指定できるようにするので）、作業区分カラーはコードを直接書くようにします-->
                <span class="article_num">工事物件No：XXXXXX</span>
                <h2>プロジェクト名</h2>
                <ul class="btn">
                  <li class="edit">
                    <a href="/projects/edit/">編集</a>
                  </li>
                  <li class="delete">
                    <span onClick="disp2()">削除</span>
                  </li>
                </ul>
                <span class="period">2016/05/01(月)～2016/05/12(月)</span>
              </div>
            </li>
            <li>
              <div class="project_info" style="border-left-color: #b149bd;"><!--次回フェーズでは作業区分を先方が編集するので（おそらくカラーコードもColorpicker等で指定できるようにするので）、作業区分カラーはコードを直接書くようにします-->
                <span class="article_num">工事物件No：XXXXXX</span>
                <h2>プロジェクト名</h2>
                <ul class="btn">
                  <li class="edit">
                    <a href="/projects/edit/">編集</a>
                  </li>
                  <li class="delete">
                    <span onClick="disp2()">削除</span>
                  </li>
                </ul>
                <span class="period">2016/05/01(月)～2016/05/12(月)</span>
              </div>
            </li>
            <li>
              <div class="project_info" style="border-left-color: #ee913e;"><!--次回フェーズでは作業区分を先方が編集するので（おそらくカラーコードもColorpicker等で指定できるようにするので）、作業区分カラーはコードを直接書くようにします-->
                <span class="article_num">工事物件No：XXXXXX</span>
                <h2>プロジェクト名</h2>
                <ul class="btn">
                  <li class="edit">
                    <a href="/projects/edit/">編集</a>
                  </li>
                  <li class="delete">
                    <span onClick="disp2()">削除</span>
                  </li>
                </ul>
                <span class="period">2016/05/01(月)～2016/05/12(月)</span>
              </div>
            </li>
            <li>
              <div class="project_info" style="border-left-color: #b8b8b8;"><!--次回フェーズでは作業区分を先方が編集するので（おそらくカラーコードもColorpicker等で指定できるようにするので）、作業区分カラーはコードを直接書くようにします-->
                <span class="article_num">工事物件No：XXXXXX</span>
                <h2>プロジェクト名</h2>
                <ul class="btn">
                  <li class="edit">
                    <a href="/projects/edit/">編集</a>
                  </li>
                  <li class="delete">
                    <span onClick="disp2()">削除</span>
                  </li>
                </ul>
                <span class="period">2016/05/01(月)～2016/05/12(月)</span>
              </div>
            </li>
            <li>
              <div class="project_info" style="border-left-color: #666666;"><!--次回フェーズでは作業区分を先方が編集するので（おそらくカラーコードもColorpicker等で指定できるようにするので）、作業区分カラーはコードを直接書くようにします-->
                <span class="article_num">注文番号：XXXXXX</span>
                <h2>現場名</h2>
                <ul class="btn">
                  <li class="edit">
                    <a href="/projects/edit/">編集</a>
                  </li>
                  <li class="delete">
                    <span onClick="disp2()">削除</span>
                  </li>
                </ul>
                <span class="period">2016/05/01(月)～2016/05/12(月)</span>
              </div>
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
  <div class="slidemenu slidemenu-right user_menu">

      <div class="slidemenu-header">
        <div class="user_box">
            <dl class="user clfx">
              <dt class="avatar"><img src="/img/common/default_avatar.png" alt="" width="62" /></dt>
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
