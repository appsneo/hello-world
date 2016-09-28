
<?php $this->assign('title', 'プロジェクト管理 単発プロジェクト | 業務管理システム'); ?>

<?php $this->start('meta') ?>
<meta name="description" content="プロジェクト管理 単発プロジェクト | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_project_detail.css" media="all" />
<?php $this->end() ?>

<?php $this->start('script') ?>
<script>
$(document).ready(function() {
   $('#a-submit').click(function(){
    $(".form-post").submit();
//    alert('Sign new href executed.');
    return false;
   });
});
</script>
<?php $this->end() ?>


<!--contentns-->
<!--大枠-->

  <section id="body">
  <?php if($from == "add") { ?>
    <form id="form-post" class="form-post" name="form-post" action='/projects/add-single/' method='post'>
  <?php } else { ?>
    <form id="form-post" class="form-post" name="form-post" action='/projects/edit-single/<?= $project->id ?>' method='post'>
  <?php } ?>

    <div class="manager_project_detail_single">
      <div class="inbox">
        <h1>プロジェクト管理 単発プロジェクト</h1>

        <ul class="hidden">
          <li>現場名は入力必須です</li>
          <li>注文番号は入力必須です</li>
        </ul>

        <?= $this->Flash->render() ?>

    <?php
      if(isset($errors)):
          $fields = 'num,project_name,client,category,money,start,end,address,charge,operators,select_file';
          echo $this->Consumer->getErrorHtml($errors, $fields, true);
      endif;
    ?>


        <h2 class="sub_title">現場名<span class="required">必須</span></h2>
        <input class="text" type="text" name="project_name" size="24" value="<?= $project->project_name ?>"/>

        <h2 class="sub_title">注文番号<span class="required">必須</span></h2>
        <input class="text" type="text" name="num" size="24" value="<?= $project->num ?>"/>


        <h2 class="sub_title">
        作業員指定
        <span class="required">必須</span>
        </h2>

        <ul class="operator_list clfx">
          <?php
            $pos = 0;
            foreach ($users as $user):
              $hit = false;
              if(isset ($project->project_users)) {
                foreach ($project->project_users as $worker):
                  if( $worker->user_id == $user->id ):
                    $hit = true;
                  endif;
                endforeach;
              }
            ?>
            <li>
              <label class="clfx">
              <dl>
                <dt><input type="checkbox" name="operators[<?= $pos++ ?>]" value="<?= $user->id ?>"  <?php if($hit) {echo 'checked="checked"'; } ?> /></dt>
                  <dd><?= $user->id ?> : <?= $user->name ?> さん</dd>
              </dl>
                </label>
            </li>
            <?php endforeach; ?>
          </ul>

          <h2 class="sub_title">
          期間指定
          <span class="required">必須</span>
          </h2>

           <div class="row">
            <div class="period clfx">
              <div class="start">
                <h3 class="sub_title"><img src="/img/common/calendar_pict.png" alt="" width="20" />工事着手日</h3>
                <input class="day datepicker" type="text" readonly="readonly" name="start" size="24" value="<?= $project->start ?>" />
                <?php if($project->project_periods) {
                    $pid = $project->project_periods[0]["id"];
                } else {
                  $pid = 0;
                }  ?>
                <input class="projectPeriods_id" type="hidden" readonly="readonly" name="projectPeriod_id" value="<?= $pid ?>"/>
              </div>
              <div class="end">
                <h3 class="sub_title"><img src="/img/common/calendar_pict.png" alt="" width="20" />工事完了日</h3>
                <input class="day datepicker" type="text" readonly="readonly" name="end" size="24" value="<?= $project->end ?>" />
              </div>
            </div>
          </div>

          <h2 class="sub_title">現場住所</h2>
          <textarea class="text" name="address" rows="2" cols="40"><?= $project->address ?></textarea>

          <h2 class="sub_title">取引会社名</h2>
          <input class="text" type="text" name="client_name" size="24" value="<?= $project->client_name ?>"/>

          <h2 class="sub_title">協力会社名(2次業者名)</h2>
          <input class="text" type="text" name="secondary" size="24" value="<?= $project->secondary ?>"/>

          <h2 class="sub_title">注文内容</h2>
          <textarea class="text" name="summary" rows="2" cols="40"><?= $project->summary ?></textarea>


          <div class="save_btn">
            <a href="#" id="a-submit">プロジェクト保存</a>
          </div>

      </div>
    </div>
  </form>
  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu'); ?>
<?= $this->element('slidemenu_false') ?>
<!--▼ユーザーメニュー-->

<script>
$(function(){
//    $('.datepicker').datepicker('setDate', 'today');
});
</script>
<script type="text/javascript">
  (function($){

    $.fn.eventeditor=function(config){
//            alert('date');

      return this.each(function(i){
        $(this).find('input.datepicker').datepicker({ dateFormat: "yy/mm/d"});

//                $(this).find('input.datepicker').datepicker({'showButtonPanel': true}).datepicker({ dateFormat: "yy/mm/d",});

      });
    };

    // execute
    $('div.period').eventeditor();

  })(jQuery);

</script>
