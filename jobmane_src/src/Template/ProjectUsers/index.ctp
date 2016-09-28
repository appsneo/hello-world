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
<?= $this->Html->css('reset.css') ?>
<?= $this->Html->css('style.css') ?>
<?= $this->Html->css('sp-slidemenu.css') ?>
<?= $this->Html->css('daily_report_list.css') ?>
<?php $this->end(); ?>

<!--[if lt IE 9]>
<script src="../js/html5.js" type="text/javascript"></script>
<script src="../js/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->

<script>
$(document).ready(function() {
   $('#a-submit').click(function(){
    $(".form-post").submit();
  //  alert('Sign new href executed.');
    return false;
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

    <div class="daily_report_list2">
      <div class="inbox">
        <h1>日報一覧</h1>

        <span class="article_num"><?= $project->num ?></span>
        <h2 class="project_title"><?= $project->project_name ?></h2>

        <form id="form-post" class="form-post" name="form-post" action='/reports/add/' method='post'>

        <div class="search_box">

          <h2>日報絞り込み</h2>

          <ul class="pulldown">
            <li>
              <select id="year" class="time" name="year_yy">
                <?php
                  for ($y=date('Y')+3; $y >= date('Y') - 3; $y--) {
                    if($y == date('Y')) {
                      print('<option value="' . $y . '" selected="selected">' . $y . '</option>');
                    } else {
                      print('<option value="' . $y . '">' . $y . '</option>');
                    }
                } ?>
              </select>
              年
            </li>
            <li>
              <select id="month" class="time" name="month_mm">
                <?php
                  for ($m=1; $m <= 12; $m++) {
                    if($m == intval(date('m'))) {
                      print('<option value="' . $m . '" selected="selected">' . $m . '</option>');
                    } else {
                      print('<option value="' . $m . '">' . $m . '</option>');
                    }
                  } ?>
              </select>
            月
            </li>
            <li>
              <select id="day" class="time" name="day_dd">
                <?php
                  for ($d=1; $d <= 31; $d++) {
                    if($d == intval(date('d'))) {
                      print('<option value="' . $d . '" selected="selected">' . $d . '</option>');
                    } else {
                      print('<option value="' . $d . '">' . $d . '</option>');
                    }
                  } ?>
              </select>
            日
            </li>
          </ul>

          <div class="edit_btn">
            <a href="#" id="a-submit">+新規作成</a>
          </div>

        </div>
        </form>

        <ul class="user_list">

					<?php foreach ($projectsUsers as $user): ?>
          <li class="clfx">
              <div class="avatar">
                <img src="/img/common/default_avatar.png" alt="" width="50" />
              </div>
              <div class="info">
                <span class="name"><?= $user->user_id ?> <?= $user->user_id ?> さんの日報</span>
                <ul class="btn">
                  <li class="edit">
                    <a href="/reports/edit/<?= $user->id ?>">編集</a>
                  </li>
                  <li class="browse">
                    <a href="/reports/view/<?= $user->id ?>">閲覧</a>
                  </li>
                </ul>
              </div>
          </li>
        <?php endforeach; ?>
          <li class="clfx">
              <div class="avatar">
                <img src="/img/common/default_avatar.png" alt="" width="50" />
              </div>
              <div class="info">
                <span class="name">○○さんの日報</span>
                <ul class="btn">
                  <li class="edit">
                    <a href="daily_report_edit_single-work.html">編集</a>
                  </li>
                  <li class="browse">
                    <a href="daily_report_print.html">閲覧</a>
                  </li>
                </ul>
              </div>
          </li>
          <li class="clfx">
              <div class="avatar">
                <img src="/img/common/default_avatar.png" alt="" width="50" />
              </div>
              <div class="info">
                <span class="name">○○さんの日報</span>
                <ul class="btn">
                  <li class="edit">
                    <a href="daily_report_edit_single-work.html">編集</a>
                  </li>
                  <li class="browse">
                    <a href="daily_report_print.html">閲覧</a>
                  </li>
                </ul>
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
  <?= $this->element('slidemenu_right'); ?>

</body>

</html>
