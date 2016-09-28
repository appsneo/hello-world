
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
    $("#form-post").attr('action', '/reports/index-project/select');
    $(".form-post").submit();
    return false;
  });
  $("#select_client").change(function(){
    $("#form-post").attr('action', '/reports/index-project');
    $("#form-post").submit();
    return false;
  });
  $("#search").click(function(){
    $("#form-post").attr('action', '/reports/index-project');
    $("#form-post").submit();
    return false;
  });
  $("#edit_single_work").click(function(){
    $("#form-post").attr('action', '/reports/index-single');
    $("#form-post").submit();
    return false;
  });
});
</script>


<!--contentns-->
<!--大枠-->
  <section id="body">
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
                <a href="#">
              <?php
              if($mode==null || $mode == '' || $mode == 'all'){
                echo '単発案件のみに絞り込む';
              } elseif($mode=='tanken'){
                echo '通常案件のみに絞り込む';
              } elseif($mode=='normal'){
                echo '絞り込み解除';
              } ?>
                  <span class="gray">▼</span>
                </a>
              </span>
            </li>
          </ul>

          <dl class="search">
            <dt><input type="text" name="search" value="<?= $search ?>" placeholder="日報No、工事物件Noで検索" /></dt>
            <dd><button id="seaech"><span></span></button></dd>
          </dl>

          <input type="hidden" name="mode" value="<?= $mode ?>" />
        </div>

        <div class="edit_single_work" id="edit_single_work">
          <a href="">単発案件作成<img src="/img/common/d-gray_arrow.png" alt="" width="10" /></a>
        </div>

        <ul class="project_list">
          <?php foreach ($projects as $project): ?>
          <li>
            <a href="/reports/index/<?= $project->id ?>">
              <span class="article_num"><?php if($project->single){echo "注文番号";}else{ echo "工事物件No";} ?>：<?= $project->num ?></span>
              <h2 class="project_title"><?= $project->project_name ?></h2>
            </a>
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
<?= $this->element('slidemenu_false') ?>
<!--▼ユーザーメニュー-->
