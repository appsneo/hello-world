
<?php $this->assign('title', '日報一覧 | 業務管理システム'); ?>

<?php $this->start('meta') ?>
<meta name="description" content="日報一覧 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/daily_report_list.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/coco_pagenation.css" media="all" />
<?php $this->end() ?>

<script>
$(document).ready(function() {
  $("#tan_anken").click(function(){
  //  alert('tan_anken');
    $("#form-post").attr('action', '/projects/index-report/select');
    $(".form-post").submit();
    return false;
  });
  $("#select_client").change(function(){
//    alert('select_client');
    $("#form-post").attr('action', '/projects/index-report');
    $("#form-post").submit();
    return false;
  });
  $("#search").click(function(){
    $("#form-post").attr('action', '/projects/index-report');
    $("#form-post").submit();
    return false;
  });
  $("#edit_single_work").click(function(){
    $("#form-post").attr('action', '/reports/index-single');
    $("#form-post").attr('method', 'post');
    $("#form-post").submit();
    return false;
  });


  $('.a_project').click(function(){
    var pos = $(".a_project").index($(this));
    var action = $(".a_project").get(pos).href; //.attr('class');
    $("#form-single").attr('action', action);
    $("#form-single").submit();
    return false;
  });

  $('a').click(function(){
//    alert( $(this).attr('href') );
    action = $(this).attr('href');
    if(action.length > 0 && action != "#") {
//        alert(action.length);
        $("#form-post").attr('action', action);
        $("#form-post").submit();
    }
    if(action == "#") {
        return true;
    }
    return false;
});

  $('.next').click(function(){
      alert('nect click');
//    var action = $(".next").child().attr('href');
//    $("#form-single").attr('action', action);
//    $("#form-single").submit();
//    return false;
  });
});
</script>


<!--contentns-->
<!--大枠-->
  <section id="body">

    <form id="form-single" name="form-single" action='' method='post'>
      <input type="hidden" name="urlfrom" value="urlfrom" />
    </form>

    <form id="form-post" class="form-post" name="form-post" action='' method='post'>

    <div class="daily_report_list">
      <div class="inbox">
        <h1>日報一覧</h1>

        <div class="search_box">

          <ul class="pulldown">
            <li>
              <select class="client" name="select_client" id="select_client" size="1">
                <option value="all">すべて</option>
                <?php foreach ($clients as $client): ?>
                  <?php if($clsel == $client->id): ?>
                    <option value="<?= $client->id ?>" <?= 'selected="selected"' ?>><?= $client->name ?></option>
                  <?php else: ?>
                    <option value="<?= $client->id ?>"><?= $client->name ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>

                <?php if($clsel == "etc"): ?>
                  <option value="etc" <?= 'selected="selected"' ?>>その他</option>
                <?php else: ?>
                  <option value="etc" >その他</option>
                <?php endif; ?>
              </select>
            </li>
            <li>
              <span class="single_work" id="tan_anken">
                <a href="/projects/index-report/select">
                単発案件のみに絞り込む
                  <span class="gray">▼</span>
                </a>
              </span>
            </li>
          </ul>

          <dl class="search">
            <dt><input type="text" name="search" value="<?= $search ?>" placeholder="日報No、工事物件Noで検索" /></dt>
            <dd><button id="search"><span></span></button></dd>
          </dl>

          <input type="hidden" name="mode" value="<?= $mode ?>" />
        </div>

        <div class="edit_single_work" id="edit_single_workxx">
          <a href="/reports/index-single">単発案件作成<img src="/img/common/d-gray_arrow.png" alt="" width="10" /></a>
        </div>

        <ul class="project_list">

      <?php if($mode == "report"): ?>

          <?php foreach ($reports as $report): ?>
          <li>
              <a href="/reports/index-single/<?= $report->id ?>" class="a_project">
                <?php
                    $title = "単発案件";
                    $num = $report->num;
                ?>
              <span class="article_num">単発案件:<?= $report->user->name ?></span>
              <h2 class="project_title"><?= $report->project_name ?></h2>
            </a>
          </li>
          <?php endforeach; ?>

      <?php else: ?>

          <?php foreach ($projects as $project): ?>
          <li>
              <a href="/reports/index/<?= $project->id ?>" class="a_project">

          <?php if(!$project->single): ?>
          <?php else:
        //      <a href="/reports/index-single/ $project->id " class="a_project">
           endif;
           ?>
                <?php
//                if($project->type == 'project') {
                    if($project->single) {
                        $title = "注文番号";
                        $num = $project->num;
                    } else {
                        $title = "工事物件No";
                        $num = $project->num;
                    }
//                } else {
//                    $title = "単発案件";
//                    $num = $project->num;
//                }
                ?>
              <span class="article_num"><?= $title . ':' . $project->num ?></span>
              <h2 class="project_title"><?= $project->project_name ?></h2>
            </a>
          </li>
          <?php endforeach; ?>
        <?php endif; ?>

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
<?= $this->element('slidemenu') ?>
<?= $this->element('slidemenu_false') ?>
<!--▼ユーザーメニュー-->
