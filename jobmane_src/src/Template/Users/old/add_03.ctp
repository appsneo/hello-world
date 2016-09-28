<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

<title>ユーザー管理 詳細 | 業務管理システム</title>
<meta name="description" content="ユーザー管理 詳細 | 業務管理システム" />
<meta name="keywords" content="業務管理システム," />
<meta name="author" content="業務管理システム" />

<?php $this->start('css'); ?>
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_user_detail.css" media="all" />
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="/js/jquery1.9.1.js" type="text/javascript"></script>
<script src="/js/jquery-migrate-1.2.1.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="/js/html5.js" type="text/javascript"></script>
<script src="/js/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->
<script>
$(document).ready(function() {
   $('a[href = "#"]').click(function(){
    $(".form-post").submit();
  //  alert('Sign new href executed.');
    return false;
   });
});
</script>
<?php $this->end(); ?>

</head>

<body>


<!-- header -->
  <header id="header">
    <div class="inbox">

      <ul>
        <li class="back_btn">
          <span onClick="history.back(); return false;">&nbsp;</span>
        </li>
        <li class="menu">
          <span class="menu-button-right">&nbsp;</span>
        </li>
        <li class="logo">
        業務管理システム
        </li>
      </ul>

    </div>
  </header>
<!-- //header -->

<!--contentns-->
<!--大枠-->
  <section id="body">

    <form id="form-post" class="form-post" name="form-post" action='/users/add' method='post'>

    <div class="manager_user_detail">
      <div class="inbox">
        <h1>ユーザー管理 詳細</h1>

          <div class="inbox2">

            <ul class="error">
              <li>お名前は入力必須です</li>
              <li>ユーザーIDは入力必須です</li>
              <li>パスワードは入力必須です</li>
              <li>パスワード再入力とパスワードが一致しません</li>
              <li>メールアドレスは入力必須です</li>
            </ul>

            <h2 class="sub_title">お名前<span class="required">必須</span></h2>
            <input class="text" type="text" name="name" size="24" />

            <h2 class="sub_title">ID</h2>
            <input class="text" type="text" name="id" size="24" value="<?= $user->id ?>" />

            <ul class="password clfx">
              <li>
                <h2 class="sub_title">パスワード<span class="required">必須</span></h2>
                <input class="password" type="password" name="password" size="24" />
              </li>
            </ul>

            <h2 class="sub_title">メールアドレス<span class="required">必須</span></h2>
            <input class="text" type="email" name="email" size="24" />


            <h2 class="any">血液型</h2>
            <div class="blood_type">
              <select id="blood_type" class="blood_type" name="blood_type">
                 <option value="-" selected="selected">-</option>
                 <option value="A">A型</option>
                 <option value="B">B型</option>
                 <option value="O">O型</option>
                 <option value="AB">AB型</option>
              </select>
           </div>

            <h2 class="any">緊急時の連絡先</h2>
            <textarea class="text" name="emergency" rows="2" cols="40"><?= h($user->emergency) ?></textarea>

            <h2 class="any">所有資格</h2>
            <textarea class="text" name="capabilities" rows="2" cols="40"><?= h($user->capabilities) ?></textarea>

            <h2 class="any">安全講習受講履歴</h2>
            <textarea class="text" name="safety" rows="2" cols="40"><?= h($user->safety) ?></textarea>

            <div class="save_btn">
              <a href="#">登録する</a>
            </div>

          </div>




      </div>
    </div>

  </section>
<!--大枠-->

  <!--▼ユーザーメニュー-->
  <div class="slidemenu slidemenu-right user_menu">

      <div class="slidemenu-header">
        <div class="user_box">
            <dl class="user clfx">
              <dt class="avatar"><img src="../img/common/default_avatar.png" alt="" width="62" /></dt>
              <dd class="name">
                <span class="name">ユーザー名</span>
                <span class="logout"><a href="#">[ログアウト]</a></span>
              </dd>
            </dl>
        </div>
      </div>

    <div class="slidemenu-body">

      <div class="slidemenu-content">
        <p class="subtitle">目次</p>
        <ul class="menu">
          <li>
            <a href="../project/project_list.html">プロジェクト一覧</a>
          </li>
          <li>
            <a href="../daily_report/daily_report_list.html">日報</a>
          </li>
          <li>
            <a href="../monthly_report/monthly_report_list.html">月報</a>
          </li>
        </ul>
        <p class="subtitle">管理者メニュー</p>
        <ul class="menu">
          <li>
            <a href="manager_user_list.html">ユーザー管理</a>
          </li>
          <li>
            <a href="#linkURL">プロジェクト管理</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</form>
  <!--▲ユーザーメニュー-->

<script type="text/javascript" src="../js/sp-slidemenu.js"></script>
  <script>
    var sp_slidemenu = SpSlidemenu({
      main               : "#body, #header",
      button             : ".menu-button-right",
      slidemenu          : ".slidemenu-right",
      slidemenu_header   : ".slidemenu-header",
      slidemenu_body     : ".slidemenu-body",
      slidemenu_content  : ".slidemenu-content",
      disableCssAnimation: false,
      disable3d          : false,
      direction          : 'right'
    });
</script>
</body>

</html>



<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('companyid');
            echo $this->Form->input('boad');
            echo $this->Form->input('password');
            echo $this->Form->input('photo');
            echo $this->Form->input('phonenumber');
            echo $this->Form->input('smartphone');
            echo $this->Form->input('status');
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
