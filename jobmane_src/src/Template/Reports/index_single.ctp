
<?php $this->assign('title', '単発案件日報一覧 | 業務管理システム'); ?>

<?php $this->start('meta') ?>
<meta name="description" content="単発案件日報一覧 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/daily_report_list.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/coco_pagenation.css" media="all" />
<?php $this->end() ?>


<script>
$(document).ready(function() {
   $('.time').change(function(){
//       alert('time');
    $(".form-post").attr('action', '/reports/index-single');
    $(".form-post").submit();
    return false;
   });
   $('#edit_btn').click(function(){
//       alert('new');
    $(".form-post").submit();
    return false;
   });
});
</script>

<style>
.success {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  background-color: #f0f8ff;
  border: solid 1px #0000cd;
  color: #0000cd;
  text-align: left;
  margin-bottom: 18px;
  padding-top: 6px;
  padding-bottom: 6px;
  padding-right: 1px;
  padding-left: 10px;
  list-style-type: none;
  vertical-align: middle;
}
.error {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  background-color: #ffd9d9;
  border: solid 1px #ff3f3f;
  color: #ff3f3f;
  text-align: left;
  margin-bottom: 18px;
  padding-top: 6px;
  padding-bottom: 6px;
  padding-right: 1px;
  padding-left: 10px;
  list-style-type: none;
  vertical-align: middle;
}
.error li:before, .success li:before {
  content: "・";
}
</style>

<script>
$(document).ready(function() {

$('.a_edit').click(function(){
//    var action = $(".a_month").attr('action');
  //alert($(".a_month").length);
  var pos = $(".a_edit").index($(this));
  //alert(pos);
  var action = $(".a_edit").get(pos).href; //.attr('class');
//    alert(elm);
//s  var action = elm.href; //attr('action');
  //alert(pos);
//    alert($this);
//  alert(action);
  $(".form-index").attr('action', action);
  $(".form-index").submit();
  return false;
});
  $('.a_view').click(function(){
    var pos = $(".a_view").index($(this));
    var action = $(".a_view").get(pos).href; //.attr('class');
  //  alert(action);
    $(".form-index").attr('action', action);
    $(".form-index").submit();
    return false;
  });
});
</script>


<!--contentns-->
<!--大枠-->
  <section id="body">

    <form id="form-index" class="form-index" name="form-index" action='' method='post'>
      <input type="hidden" name="urlfrom" value="urlfrom" />
    </form>

  <form id="form-post" class="form-post" name="form-post" action='/reports/add-single' method='post'>

    <div class="daily_report_list2">
      <div class="inbox">
        <h1>日報一覧</h1>

        <?= $this->Flash->render() ?>

        <h2 class="project_title">単発案件</h2>

        <div class="search_box">

          <h2>日報絞り込み</h2>

          <ul class="pulldown">
            <li>
              <select id="year" class="time" id="year_yy" name="year_yy">
                <?php
                  for ($y=date('Y')+3; $y >= date('Y') - 3; $y--) {
                    if($y == $year_yy) {
                      print('<option value="' . $y . '" selected="selected">' . $y . '</option>');
                    } else {
                      print('<option value="' . $y . '">' . $y . '</option>');
                    }
                } ?>
              </select>
              年
            </li>
            <li>
              <select id="month" class="time" id="month_mm" name="month_mm">
                <?php
                  for ($m=1; $m <= 12; $m++) {
                    if($m == $month_mm) {
                      print('<option value="' . $m . '" selected="selected">' . $m . '</option>');
                    } else {
                      print('<option value="' . $m . '">' . $m . '</option>');
                    }
                  } ?>
              </select>
            月
            </li>
            <li>
              <select id="day" class="time" id="day_dd" name="day_dd">
                <?php
                  for ($d=1; $d <= 31; $d++) {
                    if($d == $day_dd) {
                      print('<option value="' . $d . '" selected="selected">' . $d . '</option>');
                    } else {
                      print('<option value="' . $d . '">' . $d . '</option>');
                    }
                  } ?>
              </select>
            日
            </li>
          </ul>

          <?php if($role == "operator"): ?>
          <div class="edit_btn" id="edit_btn">
            <a href="">+新規作成</a>
          </div>
          <?php endif; ?>
        </div>

        <ul class="user_list">
            <?php foreach ($reports as $report): ?>
            <li class="clfx">

              <div class="avatar">
                <?php if( $report->user->image == null  ) { ?>
                  <img id="preview-photo" class="main_img" src="/img/common/default_avatar.png" alt="" width="50" />
                <?php } else { ?>
                <img id="preview-photo" class="main_img" src="/users/contents/<?= $report->user_id ?>" alt="" width="50" />
                <?php } ?>
              </div>


                <div class="info">
                  <span class="name"><?= $report->user->name ?> さんの日報
                  <ul class="btn">
                    <?php if($role == "president"): ?>
                    <li class="edit">
                  <?php if ($Url['from'] == "index-single"): ?>
                      <a href="/reports/edit-single/<?= $report->id ?>" class="a_edit">編集</a>
                    <?php else: ?>
                      <a href="/reports/edit/<?= $report->id ?>" class="a_edit">編集</a>
                     <?php endif; ?>
                    </li>
                    <?php endif; ?>
                    <li class="browse">
                      <a href="/reports/view/<?= $report->id ?>" class="a_view">閲覧</a>
                    </li>
                  </ul>
                </div>
            </li>
          <?php endforeach; ?>
        </ul>

        <!--▼Pagenation-->
        <?= $this->element('pagenation') ?>
        <!--▲Pagenation-->

      </div>
    </div>
  </form>
  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu'); ?>
<?= $this->element('slidemenu_false'); ?>
<!--▼ユーザーメニュー-->
