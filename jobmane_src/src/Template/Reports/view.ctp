
<?php $this->assign('title', '日報 | 業務管理システム') ?>

<?php $this->start('meta') ?>
<meta name="description" content="日報 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/daily_report_edit.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/print.css" media="print" />
<?php $this->end() ?>

<?php $this->start('script') ?>
<script src="/js/jquery1.9.1.js" type="text/javascript"></script>
<script src="/js/jquery-migrate-1.2.1.js" type="text/javascript"></script>
<script src="/js/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>

<script>
$(document).ready(function() {

  if ($('#mark-hidden').val() == "1" ) {
//    alert('end add !!');
    $("h3").addClass("end");
//    alert('end cut !!');
  }

  $('button > .cancel').click(function (e) {
      alert('Cancel');
  });

      $('#a_pre').click(function(){
          var action = $("#a_pre").attr('href');
//          alert(action);
          $(".form-print").attr('action', action);
          $(".form-print").submit();
          return false;
      });
      $('#a_next').click(function(){
          var action = $("#a_next").attr('href');
//          alert(action);
          $(".form-print").attr('action', action);
          $(".form-print").submit();
      return false;
      });

});

function print_end() {
//    alert('print end!!');
    $(".form-print").submit();
    return false;
}
</script>
<?php $this->end() ?>


<!--contentns-->
<!--大枠-->
  <section id="body">

       <form id="form-print" class="form-print" name="form-print" action='/reports/index' method='post'>
          <input type="hidden" name="report_end_id" value="<?= $report->id ?>" />
          <input type="hidden" name="year_yy" value="<?= $year_yy ?>" />
          <input type="hidden" name="month_mm" value="<?= $month_mm ?>" />
          <input type="hidden" name="day_dd" value="<?= $day_dd ?>" />
      </form>

        <div class="print_btn clfx">

          <ul class="pagenation">
              <?php if($on_left): ?>
            <li class="prev"><a href="/reports/view-pre/<?= $report->id ?>" id="a_pre"><img src="/img/common/c_back.png" alt="前へ" />前の日</a></li>
        <?php endif; ?>
                <?php if($on_right): ?>
            <li class="next"><a href="/reports/view-next/<?= $report->id ?>"id="a_next">次の日<img src="/img/common/c_next.png" alt="次へ" /></a></li>
        <?php else: ?>
        <li class="next" style="padding-right:78px;"></li>
    <?php endif; ?>
          </ul>
        <?php if($auth['role'] == 'president'): ?>
        <?php endif; ?>
          <a  href="javascript:void(0)" onclick="window.print();return false;"><img src="/img/common/print_pict.png" alt="" width="24" />日報を印刷</a>
        </div>

        <div class="daily_report_edit">
          <div class="inbox">
              <?php if($report->single): ?>
                <h1>日報 (単発案件)</h1>
            　<?php else:  ?>
                  <h1>日報</h1>
              <?php endif; ?>

            <h2 class="company_name"><?= $company->name ?></h2>

            <!--完工済みの場合class名:endを付与-->
            <div style="min-height:90px;">
            <h3 class="user_name <?php if($report->completion_check) {echo 'end';} ?>" clfx">
              <span class="name">作業員名：<?= $user->name ?></span>
            </h3>
          </div>

            <ul class="outline clfx">
              <li>
                <h4 class="sub_title">作業年月日　入場～退場：</h4>
            <?php if( $report->start_time): ?>
                <p class="content"><?= $report->work_date_str ?>&nbsp;&nbsp;<?= $report->start_time->format('G:i') ?>～<?= $report->end_time->format('G:i') ?></p>
            <?php else: ?>
                <p class="content"><?= $report->work_date_str ?></p>
            <?php endif; ?>
              </li>
              <li>
                <h4 class="sub_title">依頼元：</h4>
              <?php if($report->single): ?>
                <p class="content"><?=  $report->client_name ?>　</p>
              <?php elseif($project->single): ?>
                <p class="content"><?=  $project->client_name ?>　</p>
              <?php else: ?>
                <p class="content"><?=  $project->client->name ?>　</p>
              <?php endif; ?>
              </li>
              <li>
                <h4 class="sub_title">工事名：</h4>
              <?php if($report->single): ?>
                <p class="content"><?=  $report->project_name ?></p>
              <?php elseif($project->single): ?>
                <p class="content"><?=  $project->project_name ?></p>
              <?php else: ?>
                <p class="content"><?=  $project->project_name ?></p>
              <?php endif; ?>
              </li>
              <li>
                <h4 class="sub_title">作業種別：</h4>
                <?php if($report->single): ?>
                    <p class="content"><?= $report->category_name ?></p>
                <?php elseif($project->single): ?>
                    <p class="content">単発プロジェクト</p>
                <?php else: ?>
                    <p class="content"><?= $project->category->name ?></p>
            <?php endif; ?>
              </li>
            </ul>

        <div class="material_header clfx">
          <div class="name">使用部材</div>
          <div class="quantity">数量</div>
        </div>

        <div class="row">
  <?php foreach ($reportMaterials as $material): ?>
          <div class="material clfx">
            <div class="name">
              <p><?= $material->material->name ?></p>
            </div>

            <div class="quantity">
              <p>
                  <?php if($material->quantity == ''){ echo '　';}
                        else{ echo $material->quantity; } ?>
              </p>
            </div>
          </div>
  <?php endforeach; ?>
        </div>

        <h4 class="sub_title3">手当等</h4>
        <p class="body_txt"><?= nl2br($report->allowance) ?></p>

        <h4 class="sub_title3">備考</h4>
        <p class="body_txt"><prex><?= nl2br($report->note) ?></prex></p>

        <h4 class="sub_title3">残工事</h4>
        <p class="body_txt"><?= nl2br($report->remaining) ?></p>

      </div>

    </div>

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu') ?>
<?= $this->element('slidemenu_false') ?>
<!--▼ユーザーメニュー-->
