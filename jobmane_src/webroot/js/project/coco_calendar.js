/*
 *
 * カレンダー表示用のscript
 *
 */

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
			eventLimit: true, // allow "more" link when too many events
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
