
<?php $this->assign('title', '使用部材の 登録/編集 | 業務管理システム') ?>

<?php $this->start('meta') ?>
<meta name="description" content="使用部材の 登録/編集 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_user_detail.css" media="all" />
<?php $this->end() ?>

<?php $this->start('script') ?>
<script src="/js/jquery.repeater.js" type="text/javascript"></script>
<?php $this->end() ?>

<script>
$(document).ready(function() {
   $('#a-submit').click(function(){
    $("#form-post").submit();
    return false;
   });
   $('#a_back').click(function(){
     var action = $("#a_back").attr('href');
  //   alert(action);
     $("#form-back").attr('action', action);
     $("#form-back").submit();
    return false;
   });
});
</script>


<!--contentns-->
<!--大枠-->
  <section id="body">
    <form id="form-back" class="form-back" name="form-back" action='' method='post'>
      <input type="hidden" name="urlfrom" value="urlfrom" />
    </form>

    <form id="form-post" class="form-post" name="form-post" action='/materials/add/<?= $company->id ?>' method='post'>
      <intput type="hidden" name="company_id" value="<?= $company->id ?>" />

      <input type="hidden" id="default_company_id" name="default_company_id" value="<?= $company->id ?>"/>

    <div class="manager_user_detail">
      <div class="inbox">
        <h1><?= $company->name ?>　使用部材の 登録  / 編集</h1>


        <div class="repeater">
          <div class="material" data-repeater-list="group-a">
            <?php if($materials->count() == 0): ?>
              <div data-repeater-item>
                <input type="hidden" name="repeat_id" value=""/>
                <input type="hidden" name="company_id" value=""/>
                <input type="text" name="name" value=""/>
              </div>
            <?php endif; ?>
            <?php foreach ($materials as $material): ?>
              <div data-repeater-item>
                <input type="hidden" name="repeat_id" value="<?= $material->id ?>"/>
                <input type="hidden" name="company_id" value="<?= $company->id ?>"/>
                <input type="text" name="name" value="<?= $material->name ?>"/>
              </div>
            <?php endforeach ?>
          </div>

          <div class="edit_btn">
            <span data-repeater-create>+追加</span>
          </div>
        </div>

        <div class="save_edit_btn">
          <a href="" id="a-submit">保存して戻る</a>
        </div>

        <div class="cancel_edit_btn">
          <a href="<?= $back ?>" id="a_back">キャンセルして戻る</a>
        </div>


      </div>
    </div>
  </form>
  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?php echo $this->element('slidemenu'); ?>
<?php echo $this->element('slidemenu_false'); ?>
<!--▼ユーザーメニュー-->

<script>
$(document).ready(function () {
  'use strict';
  $('.repeater').repeater({
    defaultValues: {
      'name': '',
      'company_id': $('#default_company_id').value
    },
    show: function () {
      $(this).slideDown();
    },
    hide: function (deleteElement) {
    //未使用
      if(confirm('削除してもよろしいでしょうか？')) {
        $(this).slideUp(deleteElement);
      }
    }
  });
});
</script>
