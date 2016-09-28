
<?php $this->assign('title', '月報一覧 | 業務管理システム') ?>

<?php $this->start('meta') ?>
<meta name="description" content="月報一覧 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/monthly_report_list.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/coco_pagenation.css" media="all" />
<?php $this->end() ?>

<script>
$(document).ready( function() {
  $('.client_event').change(function() {
//    alert('client');
    $('#form-post').submit();
    return false;
  });
})
$(document).ready( function() {
  $('.time_event').change(function() {
//    alert('time');
    $('#form-post').submit();
    return false;
  });
})
</script>

<script>
$(document).ready(function() {

  $('.a_month').click(function(){
//    var action = $(".a_month").attr('action');
    //alert($(".a_month").length);
    var pos = $(".a_month").index($(this));
    //alert(pos);
    var action = $(".a_month").get(pos).href; //.attr('class');
//    alert(elm);
  //s  var action = elm.href; //attr('action');
    //alert(pos);
//    alert($this);
//  alert(action);
    $(".form-post").attr('action', action);
    $(".form-post").submit();
    return false;
  });


  $("#year_yy").change(function(){
//    $("#form-post").attr('action', '/reports/index-monthly');
    $(".form-post").submit();
    return false;
  });
  $("#month_mm").change(function(){
//    $("#form-post").attr('action', '/reports/index-monthly');
    $("#form-post").submit();
    return false;
  });
  $("#selectName").change(function(){
//    $("#form-post").attr('action', '/reports/index-monthly');
    $("#form-post").submit();
    return false;
  });
});
</script>

<!--contentns-->
<!--大枠-->
  <section id="body">

    <form id="form-index" class="form-index" name="form-index" action='/reports/index-monthly' method='post'>
     <input type="hidden" name="urlfrom" value="urlfrom" />
   </form>


    <form id="form-post" class="form-post" name="form-post" action='/reports/index-monthly' method='post'>

      <div class="monthly_report_list">
        <div class="inbox">
          <h1>月報一覧</h1>

          <div class="search_box">

            <div class="client client_event">
              <select class="client" name="selectName" id="selectName" size="1">


                  <option value="all">すべて</option>
                  <?php foreach ($clients as $client): ?>
                    <?php if($client_sel == $client->id): ?>
                      <option value="<?= $client->id ?>" <?= 'selected="selected"' ?>><?= $client->name ?></option>
                    <?php else: ?>
                      <option value="<?= $client->id ?>"><?= $client->name ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>

                  <?php if($client_sel == "etc"): ?>
                    <option value="etc" <?= 'selected="selected"' ?>>その他</option>
                  <?php else: ?>
                    <option value="etc" >その他</option>
                <?php endif; ?>

              </select>
            </div>

            <ul class="time">
              <li>
                <select class="time time_event" name="year_yy" id="year_yy">

                <?php
                $now = new \DateTime('Now');
                $yearto = intval($now->format('Y')) + 3;
                //$yearto = intval($year) + 1;
                if($year == null) {
                  $year = -1;
                }
                for ($y=$yearto; $y > $yearto-7; $y--) {
                  if($y == intval($year)) {
                    print('<option value="' . $y . '" selected="selected">' . $y . '</option>');
                  } else {
                    print('<option value="' . $y . '">' . $y . '</option>');
                  }
                } ?>
                </select>
                年
              </li>
              <li>
                <select class="time time_event" name="month_mm" id="month_mm">
                <?php
                if($month == null) {
                  $mm = -1;
                } else {
                  $mm = $month;
                }
                for ($m=1; $m <= 12; $m++) {
                  $sm = sprintf("%'.02d", $m);
                  if($m == $mm) {
                    print('<option value="' . $m . '" selected="selected">' . $sm . '</option>');
                  } else {
                    print('<option value="' . $m . '">' . $sm . '</option>');
                  }
                } ?>
                </select>
                月
              </li>
            </ul>

          </div>

          <ul class="monthly_report_list">
        <?php foreach ($projects as $project):
//          if($project->onmonth): ?>
            <li>
              <a href="/reports/index_month/<?= $project->Clients->id ?>" class="a_month">
                <span class="company_name"><?= $project->Clients->name ?></span>
                <h2 class="title"><?= $month_str ?>月の月報</h2>
              </a>
            </li>
          <?php // endif;
          endforeach ?>
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
