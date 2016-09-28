
<?php $this->assign('title', 'プロジェクト詳細　カレンダー | 業務管理システム'); ?>

<?php $this->start('meta') ?>
<meta name="description" content="プロジェクト詳細　カレンダー | 業務管理システム" />
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

<script>
$(document).ready(function() {
   $('#a_back').click(function(){
//       alert('time');
  var action = $("#a_back").attr('href');
//alert(action);
  $(".form-index").attr('action', action);
  $(".form-index").submit();
    return false;
   });
   $('#edit_btn').click(function(){
//       alert('new');
    $(".form-post").submit();
    return false;
   });
});
</script>

<!--contentns-->
<!--大枠-->
  <section id="body">

	  <?php $jsonEvents = json_encode($events); ?>
	  <div id='jsonEvents' style="display:none;"><?php echo $jsonEvents; ?></div>

		<form id="form-index" class="form-index" name="form-index" action='' method='post'>
      <input type="hidden" name="urlfrom" value="urlfrom" />
    </form>
		<input type="hidden" id="first_date" name="first_date" value="<?= $project->first_date ?>" />

    <div class="project_calendar">
      <div class="inbox">
        <h1>プロジェクト一覧</h1>

        <div class="list_btn">
          <a href="/projects/view/<?= $project->id ?>" id="a_back"><img src="/img/common/gray_arrow_back.png" alt="" width="14" />詳細へ戻る</a>
        </div>

        <h2 class="project_title"><?= $project->project_name ?> のスケジュール</h2>

        <div id="calendar"></div>

      </div>
    </div>

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?php echo $this->element('slidemenu'); ?>
<?php echo $this->element('slidemenu_false'); ?>
<!--▼ユーザーメニュー-->
