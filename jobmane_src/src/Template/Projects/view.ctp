
<?php $this->assign('title', 'プロジェクト詳細 | 業務管理システム'); ?>

<?php $this->start('meta'); ?>
<meta name="description" content="プロジェクト詳細 | 業務管理システム" />
<?php $this->end(); ?>

<?php $this->start('css'); ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/project_detail.css" media="all" />
<?php $this->end(); ?>

<style>
div.inbox ul.error, div.inbox ul.success {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  text-align: left;
  margin-top: 2px;
  margin-bottom: 2px;
  padding-top: 10px;
  padding-bottom: 8px;
  padding-right: 1px;
  padding-left: 10px;
  list-style-type: none;
  vertical-align: middle;
}
div.inbox ul.error {
  background-color: #ffd9d9;
  border: solid 1px #ff3f3f;
  color: #ff3f3f;
}

div.inbox ul.success {
  background-color: #f6f6ff;
  border: solid 1px #6f6fff;
  color: #3f3f9f;
}

.error li:before, .success li:before {
  content: "・";
}
</style>


<script>
$(document).ready(function() {
    $('#a_fig').click(function(){
        var action = $("#a_fig").attr('href');
        $(".form-index").attr('action', action);
        $(".form-index").submit();
        return false;
    });
   $('#a_cal').click(function(){
//       alert('time');
  var action = $("#a_cal").attr('href');
//alert(action);
  $(".form-index").attr('action', action);
  $(".form-index").submit();
    return false;
   });
   $('#edit_btn').click(function(){
//       alert('new');
    $(".form-post").submit();
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

    <div class="project_detail">
      <div class="inbox">
        <h1>プロジェクト詳細</h1>

       <?= $this->Flash->render() ?>

        <?php
          $fields = 'paper,name,user_id,password,password_check,email, category,money,start,end,address,charge,select_person';
          if(isset($errors)):
            echo $this->Consumer->getErrorHtml($errors, $fields, true);
          endif;
        ?>

        <!--プロジェクトが完了済みの場合class名:endを付与-->
        <div class="title_box <?php if($project->completion_check){echo "end";} ?>" >
          <div class="txt_box">
            <h2 class="project_title"><?= $project->project_name ?></h2>
          <?php if($project->single): ?>
            <span class="article_num">注文番号：<?= $project->num ?></span>
          <?php else: ?>
            <span class="article_num">工事物件No：<?= $project->num ?></span>
          <?php endif; ?>

          <?php if($project->single): ?>
            <span class="client">取引会社：
          <?php else: ?>
            <span class="client">依頼元：
          <?php endif; ?>
              <?php if($project->single) {
                echo $project->client_name;
              } else {
                echo $project->client->name;
              } ?>
            </span>
          </div>
        </div>

        <table class="period" width="100%">
          <tr>
            <th>工事着手日</th>
            <th>工事完了日</th>
          </tr>
  <?php foreach ($project->project_periods as $period): ?>
          <tr>
            <td><?= $period->startjp ?></td>
            <td><?= $period->endjp ?></td>
          </tr>
  <?php endforeach; ?>
        </table>

        <ul class="view_change_btn">
          <li>
            <a href="/projects/calendar-one/<?= $project->id ?>" id="a_cal"><img src="/img/common/calendar_pict.png" alt="" width="26" />カレンダーで確認する</a>
          </li>
        </ul>

        <h3 class="sub_title">概要</h3>
        <p class="sub_copy"><?= $project->summary ?></p>

        <h3 class="sub_title">施工場所</h3>
        <p class="sub_copy"><?= $project->address ?></p>

<?php if(!$project->single): ?>
        <div class="documents_btn">
          <?php if($project->document == null || $project->document == ""): ?>
          <a href="javascript:void(0)" style="background-color:orange;">図面書類 は 設定されていません</a>
          <?php else: ?>
          <a href="/projects/document/<?= $project->document ?>" id="a_fig">図面書類をみる</a>
          <?php endif; ?>
        </div>

        <h3 class="sub_title">建築担当者名</h3>
        <p class="person_name"><?= $project->charge ?> さん</p>
    <?php endif; ?>

        <h3 class="sub_title">メモ</h3>
        <p class="sub_copy"><?= $project->memo ?></p>

        <h3 class="sub_title">作業員</h3>
        <ul class="user_list">
  <?php foreach ($project->project_users as $worker): ?>
    <?php foreach ($projectUsers as $usr): ?>
        <?php if($usr->user->id == $worker->user_id): ?>
          <li><?= $usr->user->name ?> さん</li>
        <?php endif; ?>
    <?php endforeach; ?>
  <?php endforeach; ?>
        </ul>

      </div>
    </div>

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu') ?>
<?= $this->element('slidemenu_false') ?>
<!--▲ユーザーメニュー-->
