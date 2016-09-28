
<?php $this->assign('title', '作業種別の 登録/編集 | 業務管理システム') ?>

<?php $this->start('meta') ?>
<meta name="description" content="作業種別の 登録/編集 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_user_detail.css" media="all" />
<?php $this->end() ?>

<?php $this->start('script') ?>
<script src="/js/jquery.repeater.js" type="text/javascript"></script>
<script src="/js/jscolor.js"></script>
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
<?php $this->end() ?>


<!--contentns-->
<!--大枠-->
  <section id="body">

    <form id="form-back" class="form-back" name="form-back" action='' method='post'>
      <input type="hidden" name="urlfrom" value="urlfrom" />
    </form>

    <form id="form-post" class="form-post" name="form-post" action='/categories/add/<?= $company->id ?>' method='post'>
      <intput type="hidden" name="company_id" value="<?= $company->id ?>" />
      <input type="hidden" id="default_company_id" name="default_company_id" value="<?= $company->id ?>"/>


      <div class="manager_user_detail">
        <div class="inbox">
          <h1><?= $company->name ?>　作業種別の 登録  / 編集</h1>

          <div class="header_box clfx">
            <div class="color">色指定</div>
            <div class="category">作業種別名</div>
          </div>

          <div class="repeater">
            <div class="material" data-repeater-list="group-a">
                <?php if($categories->count() == 0): ?>
                      <div class="clfx" data-repeater-item>
                        <input type="hidden" name="repeat_id" value=""/>
                        <input type="hidden" name="company_id" value=""/>
                        <input class="jscolor color" type="text" name="color" value="ff5c5c"/>
                        <input class="category" type="text" name="name" value=""/>
                      </div>
                <?php endif; ?>
                <?php foreach ($categories as $category): ?>
                    <div class="clfx" data-repeater-item>
                        <input type="hidden" name="repeat_id" value="<?= $category->id ?>"/>
                        <input type="hidden" name="company_id" value="<?= $company->id ?>"/>
                        <input class="jscolor color"  type="text" name="color" value="<?= $category->color ?>"/>
                        <input class="category" type="text" name="name" value="<?= $category->name ?>"/>
                    </div>
                <?php endforeach ?>
            </div>

            <div class="edit_btn">
              <span data-repeater-create>+追加</span>
            </div>
          </div>

          <div class="save_edit_btn">
            <a href="#" id="a-submit">保存して戻る</a>
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
  var defaultColor = '15274d'

  $('.repeater').repeater({
    defaultValues: {
        'name': '',
        'color': defaultColor,
        'company_id': $('#default_company_id').value
    },
    show: function () {
      // 「追加」をクリックして下へずれて要素が増える処理
      $(this).slideDown();
      // 「追加」をクリックして増えた要素を検索して変数へ代入（find関数で取得すると配列になるので0番目を取得する）
      var newInputElement  = $(this).find('.jscolor')[0];
      // jscolorのインスタンスを作成引数に先に検索したinput要素を入れる
      var picker = new jscolor(newInputElement);
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
