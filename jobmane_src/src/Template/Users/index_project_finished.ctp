
<?php $this->assign('title', '完了済　担当一覧 | 業務管理システム'); ?>

<?php $this->start('meta'); ?>
<meta name="description" content="完了済　担当一覧 | 業務管理システム" />
<?php $this->end(); ?>

<?php $this->start('css'); ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_charge_list.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/coco_pagenation.css" media="all" />
<?php $this->end(); ?>

<script>
$(document).ready(function() {
  $('#a_start').click(function(){
    var action = $("#a_start").attr('href');
//    alert(action);
    $(".form-index").attr('action', action);
    $(".form-index").submit();
    return false;
  });
  $('#a_end').click(function(){
    var action = $("#a_end").attr('href');
//    alert(action);
    $(".form-index").attr('action', action);
    $(".form-index").submit();
    return false;
  });
  $('.a_view').click(function(){
    var pos = $(".a_view").index($(this));
    //alert(pos);
    var action = $(".a_view").get(pos).href; //.attr('class');
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

    <div class="manager_charge_list">
      <div class="inbox">

        <form id="form-index" class="form-index" name="form-index" action='' method='post'>
          <input type="hidden" name="urlfrom" value="urlfrom" />
        </form>

         <dl class="user">
          <dt>

            <?php if( $user->image == null ) { ?>
              <img id="preview-photo" class="main_img" width="120" heightxx="120" altx="preview"  src="/img/common/default_avatar.png" alt="" width="50" />
            <?php } else { ?>
              <img id="preview-photo" class="main_img" width="120" heightxx="120" altx="preview" src="/users/contents/<?= $user->id ?>" alt="" width="50" />
            <?php } ?>

          </dt>
          <dd>
          <?= $user->name ?>さんの<br />担当一覧
          </dd>
        </dl>

        <ul class="status_change_btn">
          <li>
            <a href="/users/index-project/<?= $user->id ?>" id="a_start">一覧</a>
          </li>
          <li class="active">
            <a href="/users/index-project-finished/<?= $user->id ?>" id="a_end">完了</a>
          </li>
        </ul>

        <ul class="list">
          <ul class="list">
  				<?php foreach ($projectUsers as $projectUser): ?>
            <li>
              <a href="/projects/view/<?= $projectUser->Projects['id'] ?>" class="a_view">
                <span class="article_num">工事物件No：<?= $projectUser->Projects['num'] ?></span>
                <h2><?= $projectUser->Projects['project_name'] ?></h2>
              </a>
            </li>
          <?php endforeach; ?>
          </ul>
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
