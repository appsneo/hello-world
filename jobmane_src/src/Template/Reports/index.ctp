
<?php $this->assign('title', '日報一覧 | 業務管理システム') ?>

<?php $this->start('meta'); ?>
<meta name="description" content="日報一覧 | 業務管理システム" />
<?php $this->end(); ?>

<?php $this->start('css'); ?>
<?= $this->Html->css('sp-slidemenu.css') ?>
<?= $this->Html->css('daily_report_list.css') ?>
<link rel="stylesheet" type="text/css" href="/css/coco_pagenation.css" media="all" />
<?php $this->end(); ?>

<script>
$(document).ready(function() {
  $('.time').change(function(){
//       alert('time');
   $(".form-post").attr('action', '/reports');
   $(".form-post").submit();
   return false;
  });
   $('#a-submit').click(function(){
    $(".form-post").submit();
  //  alert('Sign new href executed.');
    return false;
   });


  $('.a_edit').click(function(){
//    alert('edit');
//    var action = $(".a_month").attr('action');
    //alert($(".a_month").length);
    var pos = $(".a_edit").index($(this));
//    alert(pos);
//.attr('class');
  //  alert(action);
  //s  var action = elm.href; //attr('action');
    //alert(pos);
//    alert($this);
//    alert(action);
    $(".form-index").attr('action', action);
    $(".form-index").submit();
    return false;
  });

  $('.a_view').click(function(){
//    alert('view');
//    var action = $(".a_month").attr('action');
    //alert($(".a_month").length);
    var pos = $(".a_view").index($(this));
    //alert(pos);
    var action = $(".a_view").get(pos).href; //.attr('class');
//    alert(action);
  //s  var action = elm.href; //attr('action');
    //alert(pos);
//    alert($this);
//    alert(action);
    $(".form-post").attr('action', action);
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
div.daily_report_list2 ul.user_list li div.info ul.btn li.none .a_none {
  color: #fff;
  background-color: #9daec3;
  border-bottom: 2px solid #636363;
  padding:6px 26px;
  border-radius:10px;
  cursor:default;
}
div.daily_report_list2 ul.user_list li div.info ul.btn li.none .a_none:hover {
  opacity:1.0;
}
</style>


<!--contentns-->
<!--大枠-->
  <section id="body">

    <form id="form-index" class="form-index" name="form-index" action='' method='post'>
      <input type="hidden" name="urlfrom" value="urlfrom" />
    </form>


      <?php if ($project->single): ?>
  <form id="form-post" class="form-post" name="form-post" action='/reports/add' method='post'>
  <?php else: ?>
      <form id="form-post" class="form-post" name="form-post" action='/reports/add' method='post'>
  <?php endif; ?>

    <input type="hidden" name="urlfrom" value="urlfrom" />


    <div class="daily_report_list2">
      <div class="inbox">
          <h1>日報一覧</h1>

        <?= $this->Flash->render() ?>

            <?php if ($project->single): ?>
                <span class="article_num">注文番号 : <?= $project->num ?></span>
            <?php else: ?>
                <span class="article_num">工事物件No : <?= $project->num ?></span>
            <?php endif; ?>
            <h2 class="project_title"><?= $project->project_name ?></h2>


        <div class="search_box">

          <h2>日報絞り込み</h2>

          <ul class="pulldown">
            <li>
              <select id="year" class="time" name="year_yy">
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
              <select id="month" class="time" name="month_mm">
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
              <select id="day" class="time" name="day_dd">
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
          <div class="edit_btn">
            <a href="" id="a-submit">+新規作成</a>
          </div>
          <?php endif; ?>

        </div>

        <ul class="user_list">

          <?php foreach ($projectUsers as $projectUser): ?>

      <?php if($role == "president"): ?>
          <li class="clfx">
          <div class="avatar">
              <img id="preview-photo" class="main_img" src="/users/contents/<?= $projectUser->user->id ?>" alt="" width="50" />
          </div>
          <div class="info">
              <span class="name"><?= $projectUser->user->name ?> さんの日報
                  <?php if($projectUser->rp['printed']): ?>
                      &nbsp;<span style="color:red;"></span>
                  <?php endif; ?>
              <ul class="btn">

          <?php if ($projectUser->rp['id'] == null): ?>
                   <li class="none">
                       <a href="#" class="a_none">未入力</a>
                   </li>
      　  <?php else: ?>
                    <li class="edit">
              <?php if ($Url['from'] == "index-single"): ?>
                    <a href="/reports/edit-single/<?= $projectUser->rp['id'] ?>" class="a_edit">編集</a>
        　     <?php else: ?>
                    <a href="/reports/edit/<?= $projectUser->rp['id'] ?>" class="a_edit">編集</a>
        　     <?php endif; ?>
                     </li>
                     <li class="browse">
                         <a href="/reports/view/<?= $projectUser->rp['id'] ?>" class="a_view">閲覧</a>
                     </li>
        　　<?php endif; ?>
                    </ul>
                </div>
        <?php else: ?>
            <?php if ($projectUser->rp['id'] != null): ?>
                <li class="clfx">
                <div class="avatar">
                  <img id="preview-photo" class="main_img" src="/users/contents/<?= $projectUser->user->id ?>" alt="" width="50" />
                </div>
                  <div class="info">
                    <span class="name"><?= $projectUser->user->name ?> さんの日報
                    <ul class="btn">
                    <li class="browse">
                    <a href="/reports/view/<?= $projectUser->rp['id'] ?>" class="a_view">閲覧</a>
                </li>
            </ul>
          </div>
    　　      <?php endif; ?>
        <?php endif; ?>

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
<?= $this->element('slidemenu') ?>
<?= $this->element('slidemenu_false') ?>
<!--▼ユーザーメニュー-->
