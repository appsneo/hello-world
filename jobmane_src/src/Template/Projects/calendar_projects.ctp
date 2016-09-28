
<?php $this->assign('title', 'プロジェクト詳細　カレンダー | 業務管理システム'); ?>

<?php $this->start('meta') ?>
<meta name="description" content="プロジェクト詳細　カレンダー | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/project_calendar.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/fullcalendar.min.css" media="all" />
<?php $this->end() ?>

<?php $this->start('script') ?>
<!-- calendar -->
<script src="/js/project/moment.min.js" type="text/javascript" ></script>
<script src="/js/project/fullcalendar.min.js" type="text/javascript"></script>
<script src="/js/project/ja.js" type="text/javascript" ></script>
<?php $this->end() ?>


<style type="text/css">
/* カレンダーボタンの枠はみ出し対応 */
span .fc-icon {
	font-size: 1.2em;
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

]
		});

	});

</script>


<!--contentns-->
<!--大枠-->
  <section id="body">

    <div class="project_calendar">
      <div class="inbox">
        <h1>プロジェクト一覧</h1>

        <div class="list_btn">
          <a href="project_detail.html"><img src="/img/common/gray_arrow_back.png" alt="" width="14" />詳細へ戻る</a>
        </div>

        <h2 class="project_title">プロジェクト名のスケジュール</h2>

        <div id="calendar"></div>

      </div>
    </div>

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?php echo $this->element('slidemenu'); ?>
<!--▼ユーザーメニュー-->
