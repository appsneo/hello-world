
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
$(document).ready(function() {

  $('.a_mradd').click(function(){
    var pos = $(".a_mradd").index($(this));
    var action = $(".a_mradd").get(pos).href; //.attr('class');
    $(".form-post").attr('action', action);
    $(".form-post").submit();
    return false;
  });

  $('#aa_mredit').click(function(){
    var action = $("#a_mredit").attr('action');
  //  alert(action);
    $(".form-post").attr('action', action);
    $(".form-post").submit();
    return false;
  });

  $('.a_mredit').click(function(){
  //  alert('mr-edit');
//    var action = $(".a_month").attr('action');
    //alert($(".a_month").length);
    var pos = $(".a_mredit").index($(this));
    //alert(pos);
    var action = $(".a_mredit").get(pos).href; //.attr('class');
//    alert(elm);
  //s  var action = elm.href; //attr('action');
    //alert(pos);
//    alert($this);
  //  alert(action);
    $(".form-post").attr('action', action);
    $(".form-post").submit();
    return false;
  });


    $('.a_mrview').click(function(){
  //    alert('mr-view');
  //    var action = $(".a_month").attr('action');
      //alert($(".a_month").length);
      var pos = $(".a_mrview").index($(this));
      //alert(pos);
      var action = $(".a_mrview").get(pos).href; //.attr('class');
  //    alert(elm);
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

<!--contentns-->
<!--大枠-->
  <section id="body">

    <form id="form-post" class="form-post" name="form-post" action='' method='post'>
      <input type='hidden' name='urlfrom' value='urlfrom' />
    </form>

    <div class="monthly_report_list">
      <div class="inbox">
        <h1>月報一覧</h1>

        <?= $this->Flash->render() ?>

        <h2 class="monthly_title">
          <?php if($client) {
            $cname = $client->name;
          } else {
            $cname = '';
          } ?>
          <span class="client"><?= $cname ?></span>
          <span class="time"><?= $year ?>年<?= $month ?>月の月報一覧</span>
        </h2>

        <ul class="user_list">
          <?php foreach ($projects as $puser): ?>
          <li class="clfx">
              <div class="avatar">
                <img src="/users/contents/<?= $puser->pu['user_id'] ?>" alt="" width="50" />
              </div>
              <div class="info">
                <span class="name"><?= $puser->pu['user_name'] ?> さんの月報</span>
                <ul class="btn">
                <?php if($auth['role'] == "president" && empty($puser->mr['id'])) : ?>
                  <li class="edit">
                    <a href="/reports/add_month/<?= $puser->pu['user_id'] ?>" class="a_mradd">作成</a>
                <?php elseif($auth['role'] == "president") : ?>
                  <li class="edit">
                    <a href="/reports/edit_month/<?= $puser->pu['user_id'] ?>" class="a_mredit">編集</a>
                <?php elseif($auth['role'] == "operator" && null == $puser->mr['id']) : ?>
                  <li class="edit">
                    <a href="#" style="background-color:#adbee3">作成待ち</a>
                <?php endif; ?>
                  </li>
                  <li class="browse" style="Enable:false">
                  <?php if(null != $puser->mr['id']) : ?>
                    <?php if($puser->rep_exist) : ?>
                    <a href="/reports/view-month/<?= $puser->mr['id'] ?>" class="a_mrview">閲覧</a>
                    <?php else: ?>
                    <a href="/reports/view-month/<?= $puser->mr['id'] ?>" class="a_mrview"> 0 件</a>
                    <?php endif; ?>
                  <?php endif; ?>
                  </li>
                </ul>
              </div>
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
<!--▲ユーザーメニュー-->
