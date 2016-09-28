<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

<title>プロジェクト一覧　カレンダー | 業務管理システム</title>
<meta name="description" content="プロジェクト一覧　カレンダー | 業務管理システム" />
<meta name="keywords" content="業務管理システム," />
<meta name="author" content="業務管理システム" />

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/project_calendar.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/fullcalendar.min.css" media="all" />
<?php $this->end() ?>

<?php $this->start('script') ?>
<script src="/js/jquery1.9.1.js" type="text/javascript"></script>
<script src="/js/jquery-migrate-1.2.1.js" type="text/javascript"></script>
<!-- calendar -->
<script type="text/javascript" src="/js/project/moment.min.js"></script>
<script type="text/javascript" src="/js/project/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="/js/project/fullcalendar.min.js"></script>
<script type="text/javascript" src="/js/project/ja.js"></script>

<!--[if lt IE 9]>
<script src="../js/html5.js" type="text/javascript"></script>
<script src="../js/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->
<?php $this->end() ?>


<style type="text/css">
/* イベント　バーカラー */
.class-a{
	border-color: #3a87ad;
	background: #3a87ad;
	color: #fff;
}
.class-b{
	border-color: #73ad3a;
	background: #73ad3a;
	color: #fff;
}
.class-c{
	border-color: #ad4d3a;
	background: #ad4d3a;
	color: #fff;
}
.class-d{
	border-color: #c97c22;
	background: #c97c22;
	color: #fff;
}
.class-e{
	border-color: #904685;
	background: #904685;
	color: #fff;
}

/* バーの余白 */
td.fc-event-container{
	padding-bottom: 5px;
}
.fc-sun { color: #999999; }  /* 日曜日 */
.fc-sat { color: #999999; } /* 土曜日 */
.delete-events_class,
.delete-events_date{
	display: table;
	width: 300px;
	padding: 0;
	margin: 0 auto;
}
.delete-events_date{
	width: 720px;
}
.delete-events_class li,
.delete-events_date li{
	display: table-cell;
	padding: 5px 10px;
	text-align: center;
}
.delete-events_class li a{
	padding: 5px;
}
.fc-time{
	display: none;
}
</style>

<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			header: {
					left: 'prev,next',
					center: 'title',
					right: 'today'
				},
			defaultDate: '2016-07-01',
			editable: true,
			eventLimit: false, // allow "more" link when too many events
			eventLimitText:'その他',
			lang:'ja',
	// カレンダーの縦横比(比率が大きくなると高さが縮む)
	aspectRatio: 1.1,
//ヘッダーの書式
columnFormat: {
	month: 'ddd',    // 月
	week: 'D[(]ddd[)]', // 7(月)
	day: 'D[(]ddd[)]' // 7(月)

},
// タイトルの書式
titleFormat: {
	month: 'YYYY年 M月',                             // 2014年9月
	week: 'YYYY年 M月 D日',
	day: 'YYYY年 M月 D日[(]ddd[)]',                  // 2014年9月7日(火)
},


// ボタン文字列
buttonText: {
//	prev: '前',
//	next: '次',
	prevYear: '前年',
	nextYear: '翌年',
	today: '今日',
	month: '月',
	week: '週',
	day: '日'
},

//ドラッグ可能
editable: false,
selectable:false,
selectHelper:false,


			events: [
	{
		"id": "event_a-00",
		"title": "Aアパート",
		"className": "class-a",
		"url": "project_detail.html",
		"start": "2016-07-01T00:00:00",
		"end": "2016-07-04T23:59:59"
	},
	{
		"id": "event_a-00",
		"title": "Aアパート",
		"className": "class-a",
		"url": "project_detail.html",
		"start": "2016-07-06T00:00:00",
		"end": "2016-07-12T23:59:59"
	},
	{
		"id": "event_a-01",
		"title": "Cアパート",
		"className": "class-c",
		"url": "project_detail.html",
		"start": "2016-07-06T00:00:00",
		"end": "2016-07-12T23:59:59"
	},
	{
		"id": "event_a-03",
		"title": "Dアパート",
		"className": "class-d",
		"url": "project_detail.html",
		"start": "2016-07-06T00:00:00",
		"end": "2016-07-12T23:59:59"
	},
	{
		"id": "event_a-04",
		"title": "Eアパート",
		"className": "class-e",
		"url": "project_detail.html",
		"start": "2016-07-06T00:00:00",
		"end": "2016-07-12T23:59:59"
	},
	{
		"id": "event_a-02",
		"title": "Bアパート",
		"className": "class-b",
		"url": "project_detail.html",
		"start": "2016-07-05T00:00:00",
		"end": "2016-07-11T23:59:59"
	}
]
		});

	});

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

    <div class="project_calendar">
      <div class="inbox">
        <h1>プロジェクト一覧</h1>

        <div class="list_btn">
          <a href="project_company_list.html"><img src="/img/common/gray_arrow_back.png" alt="" width="14" />自社のリストへ</a>
        </div>

        <dl class="user">
          <dt>
            <img src="/img/common/default_avatar.png" alt="" width="50" />
          </dt>
          <dd>
          ○○さんのスケジュール
          </dd>
        </dl>

        <div id="calendar"></div>

      </div>
    </div>

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu_right') ?>
<!--▲ユーザーメニュー-->

</body>

</html>
