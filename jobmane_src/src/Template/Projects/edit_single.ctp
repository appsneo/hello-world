
<?php $this->assign('title', 'プロジェクト管理 単発プロジェクト | 業務管理システム'); ?>

<?php $this->start('meta') ?>
<meta name="description" content="プロジェクト管理 単発プロジェクト | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/project_calendar.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_project_detail.css" media="all" />
<?php $this->end() ?>

<?php $this->start('script') ?>
<script src="/js/jquery-ui-1.10.4.custom.js"></script>
<script src="/js/jquery.ui.datepicker-ja.js"></script>
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
<style>
div.flash {
  margin-bottom: 8px;
}

div.inbox ul.error, div.inbox ul.success {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  text-align: left;
  margin-bottom: 20px;
  padding-top: 10px;
  padding-right: 1px;
  padding-left: 10px;
  list-style-type: none;
  vertical-align: middle;
}

div.inbox ul.error {
  background-color: #ffd9d9;
  border: solid 1px #ff3f3f;
  color: #ff3f3f;
  padding-bottom: 0px;
}

div.inbox ul.success {
  background-color: #f6f6ff;
  border: solid 1px #6f6fff;
  color: #3f3f9f;
  padding-bottom: 8px;
}

.error li:before, .success li:before {
  content: "・";
}
.ui-dialog {
  z-index: 1000;
}

/* dialog header */
.ui-widget-header
{
  background-color: #45577d;
  background-image: none;
  color: White;
}
.ui-dialog-titlebar {
  text-align: center;
}
.ui-dialog .ui-dialog-content {
  text-align: center;
  min-height:35px;
}
</style>

<!--contentns-->
<!--大枠-->

  <section id="body">
    <?php if($mode == "add") { ?>
      <form id="form-post" class="form-post" name="form-post" action='/projects/add-single/' method='post'>
    <?php } else { ?>
      <form id="form-post" class="form-post" name="form-post" action='/projects/edit-single/<?= $project->id ?>' method='post'>
    <?php } ?>

    <input type="hidden" name="edit_single" value="edit_single" />

    <div class="manager_project_detail">
      <div class="inbox">
        <h1>プロジェクト管理 単発プロジェクト</h1>


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
                $operator_id = 0;
                if($project->project_users):
                  foreach ($project->project_users as $worker):
                    if( $worker->user_id == $user->id ):
                      $hit = true;
                      $operator_id = $worker->id;
                      break;
                    endif;
                  endforeach;
                endif;

          echo '<li>';
            echo '<label class="clfx">';
            echo '<dl>';
                echo '<dt>';
                  echo '<input type="checkbox" name="operators[' . $pos . ']" value="' . $user->id . '" ';
                  if($hit) {echo 'checked="checked"'; }
                  echo ' />';
                    echo '<input type="hidden" name="operator_ids[' . $pos++  . ']" value="' . $operator_id . '" />';
                echo '</dt>';
                    echo '<dd>' . $user->name  . ' さん</dd>';
                  echo '</dl>';
                echo '</label>';
              echo '</li>';
            endforeach;
          ?>
                </ul>
            <h2 class="sub_title">
              期間指定
          <span class="required">必須</span>
            </h2>

           <div class="row">
                <div class="period clfx">
                <div class="start">
                  <h3 class="sub_title"><img src="/img/common/calendar_pict.png" alt="" width="20" />工事着手日</h3>
                  <input class="day datepicker" data-date-format="yy/mm/d" type="text" readonly="readonly" name="start" size="24" value="<?= $project->project_periods[0]['start'] ?>" />
                  <input class="projectPeriod_id" type="hidden" readonly="readonly" name="projectPeriod_id" value="<?= $project->project_periods[0]['id'] ?>"/>
                </div>
                <div class="end">
                  <h3 class="sub_title"><img src="/img/common/calendar_pict.png" alt="" width="20" />工事完了日</h3>
                  <input class="day datepicker" data-date-format="yy/mm/d" type="text" readonly="readonly" name="end" size="24" value="<?= $project->project_periods[0]['end'] ?>" />
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

          <div class="completion">
            <span class="check">
              <input id="completion_check" type="checkbox" name="completion_check" value="1" <?php if($project->completion_check){echo 'checked="checked"';} ?>/>
            </span>
            <span class="check_copy"><label for="completion_check">プロジェクトが完了したらチェックをして保存</label></span>
          </div>

      </div>
    </div>

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?php echo $this->element('slidemenu'); ?>
<?php echo $this->element('slidemenu_false'); ?>
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
//                $(this).find('input.datepicker').datepicker({ dateFormat: "yy/mm/d"});

                $(this).find('input.datepicker').datepicker({'showButtonPanel': true}).datepicker({ dateFormat: "yy/mm/d",});


            });
        };

        // execute
        $('div.period').eventeditor();

    })(jQuery);


   </script>
