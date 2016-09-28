
<?php $this->assign('title', 'プロジェクト　完了済み一覧 | 業務管理システム'); ?>

<?php $this->start('meta') ?>
<meta name="description" content="プロジェクト　完了済み一覧 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/project_list.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/coco_pagenation.css" media="all" />
<?php $this->end() ?>

<script>
$(document).ready(function() {
  $('#a_list').click(function(){
    var action = $("#a_list").attr('href');
  //  alert(action);
    $(".form-index").attr('action', action);
    $(".form-index").submit();
    return false;
  });
  $('#a_kan').click(function(){
    var action = $("#a_kan").attr('href');
  //  alert(action);
    $(".form-index").attr('action', action);
    $(".form-index").submit();
    return false;
  });
  $('#a_cal').click(function(){
    var action = $("#a_cal").attr('href');
//    alert(action);
    $(".form-index").attr('action', action);
    $(".form-index").submit();
    return false;
  });
  $('#a_group').click(function(){
    var action = $("#a_group").attr('href');
  //  alert(action);
    $(".form-index").attr('action', action);
    $(".form-index").submit();
    return false;
  });
  $('.a_project').click(function(){
//    var action = $(".a_month").attr('action');
    //alert($(".a_month").length);
    var pos = $(".a_project").index($(this));
    //alert(pos);
    var action = $(".a_project").get(pos).href; //.attr('class');
//    alert(elm);
  //s  var action = elm.href; //attr('action');
    //alert(pos);
//    alert($this);
//    alert(action);
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

    <div class="project_list">
      <div class="inbox">
        <h1>プロジェクト一覧</h1>

        <ul class="view_change_btn">
          <li>
<?php if($auth['role'] == 'president'): ?>
    <a href="/projects/calendar-company/" id="a_cal"><img src="/img/common/calendar_pict.png" alt="" width="26" />カレンダー表示</a>
<?php else: ?>
    <a href="/projects/calendar-worker/" id="a_cal"><img src="/img/common/calendar_pict.png" alt="" width="26" />カレンダー表示</a>
<?php endif; ?>
          </li>
<?php if($auth['role'] == 'president'): ?>
          <li>
            <a href="/projects/index-projects" id="a_gourp"><img src="/img/common/table_pict.png" alt="" width="30" />プロジェクト別表示</a>
          </li>
<?php endif; ?>
        </ul>

        <ul class="status_change_btn">
          <li>
            <a href="/projects/index-worker/" id="a_list">一覧</a>
          </li>
          <li class="active">
            <a href="/projects/index-worker-finished/" id="a_kan">完了</a>
          </li>
        </ul>

        <ul class="list">
    <?php foreach ($projects as $project): ?>
          <li class="completion">
            <a href="/projects/view/<?= $project->id ?>" class="a_project">
              <span class="article_num"><?php if($project->single){echo "注文番号";}else{ echo "工事物件No";} ?>：<?= $project->num ?></span>
              <h2><?= $project->project_name ?></h2>
              <span class="period"><?= $project->start_str ?>〜<?= $project->end_str ?></span>
            </a>
          </li>
    <?php endforeach; ?>

        </ul>

        <!--▼Pagenation-->
        <?= $this->element('pagenation') ?>
        <!--▲Pagenation-->


      </div>
    </div>

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu') ?>
<?= $this->element('slidemenu_false') ?>
<!--▼ユーザーメニュー-->
