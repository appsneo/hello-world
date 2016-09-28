
<?php $this->assign('title', 'パスワードの変更 | 業務管理システム') ?>

<?php $this->start('meta') ?>
<meta name="description" content="パスワードの変更 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_user_detail.css" media="all" />
<?php $this->end() ?>

<?php $this->start('script') ?>
<script>
$(document).ready(function() {
  $('#a-submit').click(function(){
    $("#form-post").submit();
    return false;
  });
});
</script>
<?php $this->end() ?>


<!--contentns-->
<!--大枠-->
  <section id="body">
    <form id="form-post" class="form-post" name="form-post" action="/users/password/<?= $user_id ?>" method="post">

      <div class="manager_user_detail">
        <div class="inbox">
          <h1>パスワードの変更</h1>

            <div class="inbox2">

              <ul class="error" style="display:none;">
                <li>現在のパスワードは入力必須です</li>
                <li>新しいパスワードは入力必須です</li>
                <li>新しいパスワード再入力と新しいパスワードが一致しません</li>
              </ul>
              <dl class="flash"  onclick="this.classList.add('hidden')">
              <?= $this->Flash->render() ?>
              </dl>
              <?php if(isset($errors)): ?>
                <?php echo $this->Consumer->getErrorHtml((isset($errors) ? $errors : ''), 'password01,password02,password03', true); ?>
              <?php endif; ?>

              <h2 class="sub_title">現在のパスワード<span class="required">必須</span></h2>
              <input class="password" type="password" name="password01" size="24" />

              <h2 class="sub_title">新しいパスワード<span class="required">必須</span></h2>
              <input class="password" type="password" name="password02" size="24" />

              <h2 class="sub_title">新しいパスワード<span class="small">再入力</span><span class="required">必須</span></h2>
              <input class="password" type="password" name="password03" size="24" />


              <div class="save_btn">
                <a href="#" id="a-submit">このパスワードで登録する</a>
            </div>

          </div>

        </div>
      </div>
    </form>
  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu') ?>
<?= $this->element('slidemenu_false'); ?>
<!--▲ユーザーメニュー-->
