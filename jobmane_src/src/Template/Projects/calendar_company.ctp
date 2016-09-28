
<?php $this->assign('title', 'プロジェクト一覧　カレンダー | 業務管理システム'); ?>

<?php $this->start('css') ?>
<meta name="description" content="プロジェクト一覧　カレンダー | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/project_calendar.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/fullcalendar.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/coco_calendar.css" media="all" />
<?php $this->end() ?>

<?php $this->start('script') ?>
<!-- calendar -->
<script type="text/javascript" src="/js/project/moment.min.js"></script>
<script type="text/javascript" src="/js/project/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="/js/project/fullcalendar.min.js"></script>
<script type="text/javascript" src="/js/project/ja.js"></script>
<?php $this->end() ?>

<script>
	$(document).ready(function() {

		var jData = $('#jsonEvents').html();

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next',
				center: 'title',
				right: 'today'
			},
			defaultDate: $("#first_date").val(),
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
				month: 'YYYY年 M月',	// 2014年9月
				week: 'YYYY年 M月 D日',
				day: 'YYYY年 M月 D日[(]ddd[)]',	// 2014年9月7日(火)
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

			events: jQuery.parseJSON(jData)
		});
	});
</script>


<!--contentns-->
<!--大枠-->
  <section id="body">

	  <?php $jsonEvents = json_encode($events); ?>
	  <div id='jsonEvents' style="display:none;"><?php echo $jsonEvents; ?></div>

		<input type="hidden" id="first_date" name="first_date" value="<?= $company->first_date ?>" />

    <div class="project_calendar">
      <div class="inbox">
        <h1>会社全体のプロジェクト一覧</h1>

        <dl class="user">
          <dd>
          <?= $company->name ?> のスケジュール
          </dd>
        </dl>

        <div id="calendar"></div>

      </div>
    </div>

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu') ?>
<?= $this->element('slidemenu_false') ?>
<!--▲ユーザーメニュー-->
