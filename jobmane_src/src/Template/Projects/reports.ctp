
<?php $this->assign('title', 'プロジェクト別 詳細状況 | 業務管理システム'); ?>

<?php $this->start('meta') ?>
<meta name="description" content="プロジェクト別 詳細状況 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/project_table_detail.css" media="all" />
<?php $this->end() ?>

<?php $this->start('script') ?>
<script src="/js/project/table_fixed.js" type="text/javascript"></script>
<?php $this->end() ?>

<script>
$(document).ready(function() {
  $('#a_back').click(function(){
    var action = $("#a_back").attr('href');
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

    <div class="project_table_detail">
      <div class="inbox">
        <h1>プロジェクト別 詳細状況</h1>

        <div class="list_btn">
          <a href="/projects/index-projects" id="a_back"><img src="/img/common/gray_arrow_back.png" alt="" width="14" />プロジェクト別一覧へ戻る</a>
        </div>

        <h2 class="title">
          <?= $project->project_name ?>
    <?php
      $status = "???";
      if($project->status == "progress") {
        $status = "進行中";
      }
      elseif($project->status == "not_started") {
        $status = "未着手";
      }
      elseif($project->status == "end") {
        $status = "終了";
      }
    ?>
            <span class="<?= $project->status ?>"><?= $status ?></span><!--進行中はclass名：progress未着手はclass名：not_started終了はclass名：endをそれぞれ付与と文言変更-->
        </h2>

        <table class="memo" width="100%">
          <tr>
            <th width="27%">備考(メモ)</th>
            <td><?= h($project->memo) ?>
            </td>
          </tr>
        </table>

        <table class="work_list tablelock" width="100%">
        <thead>
          <tr>
            <th width="8%">日付</th>
            <th width="68%">作業内容</th>
            <th width="24%">作業者</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($reports as $report): ?>

          <tr>
            <td width="8%"><?= $report->work_date->format('Y/m/d') ?></td>
            <td width="68%"><?= $report->note ?></td>
            <td width="24%"><?= $report->user->name ?></td>
          </tr>

        <?php endforeach; ?>

        </tbody>
        </table>

      </div>
    </div>

  </section>
<!--大枠-->


<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu') ?>
<?= $this->element('slidemenu_false') ?>
<!--▼ユーザーメニュー-->
