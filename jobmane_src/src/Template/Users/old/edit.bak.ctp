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
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_user_detail.css" media="all" />
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script>

$(function(){
    var setFileInput = $('#select-file');

    setFileInput.each(function(){
        var selfFile = $(this),
        selfInput = $(this).find('input[type=file]');
        selfInput.change(function(){
//          alert('changed');
            var file = $(this).prop('files')[0],
            fileRdr = new FileReader(),
            selfImg = selfFile.find('#avatar');

            if(!this.files.length){
                if(0 < selfImg.size()){
                    selfImg.remove();
                    return;
                }
            } else {
                if(file.type.match('image.*')){
                    if(!(0 < selfImg.size())){
                        selfFile.append('<img alt="" class="main_img">');
                    }
                    var prevElm = $("#avatar").find('.main_img');
                    fileRdr.onload = function() {
                        prevElm.attr('src', fileRdr.result);
                    }
                    fileRdr.readAsDataURL(file);
                } else {
                    if(0 < selfImg.size()){
                      alert('image remove.');
                        selfImg.remove();
                        return;
                    }
                }
            }
        });
    });
});


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

      <?php if( $mode === "add"): ?>
      <form id="form-post" enctype="multipart/form-data" accept-charset="utf-8" class="form-post" name="form-post" action='/users/add/' method='post'>
      <?php else: ?>
          <form id="form-post" enctype="multipart/form-data" accept-charset="utf-8" class="form-post" name="form-post" action='/users/edit/<?= $user->id ?>' method='post'>
      <?php endif; ?>
    <div class="manager_user_detail">
      <div class="inbox">
        <h1>ユーザー管理 詳細</h1>

          <div class="inbox2">

            <ul class="error" style="display: none;">
              <li>お名前は入力必須です</li>
              <li>ユーザーIDは入力必須です</li>
              <li>メールアドレスは入力必須です</li>
            </ul>

            <dl class="flash">
              <?= $this->Flash->render() ?>
            </dl>

            <?php
              $fields = 'name,user_id,password,password_check,email, category,money,start,end,address,charge,select_person';
              if(isset($errors)):
                echo $this->Consumer->getErrorHtml($errors, $fields, true);
              endif;
            ?>
            <h2 class="sub_title">お名前<span class="required">必須</span></h2>
            <input class="text" type="text" name="name" size="24" value="<?= h($user->name) ?>"/>


            <h2 class="sub_title">ユーザーID<span class="required">必須</span></h2>
            <input class="text" type="text" name="user_id" size="24" value="<?= h($user->user_id) ?>"/>

<?php if($mode == "add"): ?>
            <ul class="password clfx">
              <li>
                <h2 class="sub_title">パスワード<span class="required">必須</span></h2>
                <input class="password" type="password" name="password" size="24" />
              </li>
              <li>
                <h2 class="sub_title">パスワード<span class="small">再入力</span><span class="required">必須</span></h2>
                <input class="password" type="password" name="password_check" size="24" />
              </li>
            </ul>
<?php else: ?>

            <p class="password_change">
              <a href="/users/password/<?= $user->id ?>">⇒パスワードの変更はこちら</a>
            </p>
<?php endif; ?>

            <h2 class="sub_title">メールアドレス<span class="required">必須</span></h2>
            <input class="text" type="email" name="email" size="24" value="<?= $user->email; ?>"/>

            <div class="row clfx">

              <div class="left_box">
                <dl class="authority">
                  <dt>権限：</dt>
                  <dd>
                    <select class="authority_select" name="role" size="1">
                      <option value="operator" selected="selected">作業員</option>
                    </select>
                  </dd>
                </dl>
              </div>

              <div class="right_box">
                <dl class="account_status">
                  <dt>
                    <input id="account_status" class="account_status" type="checkbox" name="account_status" value="account_on" />
                  </dt>
                  <dd>
                    <label for="account_status">アカウント状態</label>
                    <span class="small">
                      アクティブにする場合はチェックを入れて登録ボタンを押す。
                    </span>
                  </dd>
                </dl>
              </div>

            </div>

            <div id="avatar">
              <?php if( $user->isNew() ) { ?>
                <img id="preview-photo" class="main_img" width="120" heightxx="120" altx="preview"  src="/img/common/default_avatar.png" alt="" width="50" />
              <?php } else { ?>
              <img id="preview-photo" class="main_img" width="120" heightxx="120" altx="preview" src="/users/contents/<?= $user->id ?>" alt="" width="50" />
              <?php } ?>
            </div>
            <div id="select-file" >
              <input type="file" id="select-photo" class="file" name="photo" id="photo" onchangexxx="imgUpload(this)" />
            </div>

            <h2 class="any">最新健康診断年月日</h2>
            <ul class="pulldown">
              <li>
                <select id="year01" class="time" name="medical_checkup_year_yy">
                  <option value="-" selected="selected">-</option>
                  <?php
                  if($user->medical_checked_date == null) {
                    $yy = 0;
                  } else {
                    $yy = $user->medical_checked_date->format('Y');
                  }
                  for ($y=date('Y'); $y >= date('Y') - 100; $y--) {
                    if($y == intval($yy)) {
                      print('<option value="' . $y . '" selected="selected">' . $y . '</option>');
                    } else {
                      print('<option value="' . $y . '">' . $y . '</option>');
                    }
                  } ?>
                </select>
                年
              </li>
              <li>
              <select id="month01" class="time" name="medical_checkup_month_mm">
                <option value="-" selected="selected">-</option>
                <?php
                if($user->medical_checked_date == null) {
                  $mm = 0;
                } else {
                  $mm = $user->medical_checked_date->format('m');
                }
                for ($m=1; $m <= 12; $m++) {
                  if($m == intval($mm)) {
                    print('<option value="' . $m . '" selected="selected">' . $m . '</option>');
                  } else {
                    print('<option value="' . $m . '">' . $m . '</option>');
                  }
                } ?>
              </select>
              月
              </li>
              <li>
              <select id="day01" class="time" name="medical_checkup_day_dd">
                <option value="-" selected="selected">-</option>
                <?php
                if($user->medical_checked_date == null) {
                  $dd = 0;
                } else {
                  $dd = $user->medical_checked_date->format('d');
                }
                for ($d=1; $d <= 31; $d++) {
                  if($d == intval($dd)) {
                    print('<option value="' . $d . '" selected="selected">' . $d . '</option>');
                  } else {
                    print('<option value="' . $d . '">' . $d . '</option>');
                  }
                } ?>
              </select>
              日
              </li>
            </ul>


            <h2 class="any">入社年月日</h2>
            <ul class="pulldown">
              <li>
                <select id="year02" class="time" name="joined_year_yy">
                  <option value="-" selected="selected">-</option>
                  <?php
                  if($user->joined_date == null) {
                    $yy = 0;
                  } else {
                    $yy = $user->joined_date->format('Y');
                  }
                  for ($y=2016; $y >= 1900; $y--) {
                    if($y == intval($yy)) {
                      print('<option value="' . $y . '" selected="selected">' . $y . '</option>');
                    } else {
                      print('<option value="' . $y . '">' . $y . '</option>');
                    }
                  } ?>
                </select>
                年
              </li>
              <li>
              <select id="month02" class="time" name="joined_month_mm">
                <option value="-" selected="selected">-</option>
                <?php
                if($user->joined_date == null) {
                  $mm = 0;
                } else {
                  $mm = $user->joined_date->format('m');
                }
                for ($m=1; $m <= 12; $m++) {
                  if($m == intval($mm)) {
                    print('<option value="' . $m . '" selected="selected">' . $m . '</option>');
                  } else {
                    print('<option value="' . $m . '">' . $m . '</option>');
                  }
                } ?>
              </select>
              月
              </li>
              <li>
              <select id="day02" class="time" name="joined_day_dd">
                <option value="-" selected="selected">-</option>
                <?php
                if($user->joined_date == null) {
                  $dd = 0;
                } else {
                  $dd = $user->joined_date->format('d');
                }
                for ($d=1; $d <= 31; $d++) {
                  if($d == intval($dd)) {
                    print('<option value="' . $d . '" selected="selected">' . $d . '</option>');
                  } else {
                    print('<option value="' . $d . '">' . $d . '</option>');
                  }
                } ?>
              </select>
              日
              </li>
            </ul>


            <h2 class="any">退社年月日</h2>
            <ul class="pulldown">
              <li>
                <select id="year03" class="time" name="leaving_year_yy">
                  <option value="-" selected="selected">-</option>
                  <?php
                  if($user->leaving_date == null) {
                    $yy = 0;
                  } else {
                    $yy = $user->leaving_date->format('Y');
                  }
                  for ($y=2016; $y >= 1900; $y--) {
                    if($y == intval($yy)) {
                      print('<option value="' . $y . '" selected="selected">' . $y . '</option>');
                    } else {
                      print('<option value="' . $y . '">' . $y . '</option>');
                    }
                  } ?>
                </select>
                年
              </li>
              <li>
              <select id="month03" class="time" name="leaving_month_mm">
                <option value="-" selected="selected">-</option>
                <?php
                if($user->leaving_date == null) {
                  $mm = 0;
                } else {
                  $mm = $user->leaving_date->format('m');
                }
                for ($m=1; $m <= 12; $m++) {
                  if($m == intval($mm)) {
                    print('<option value="' . $m . '" selected="selected">' . $m . '</option>');
                  } else {
                    print('<option value="' . $m . '">' . $m . '</option>');
                  }
                } ?>
              </select>
              月
              </li>
              <li>
              <select id="day03" class="time" name="leaving_day_dd">
                <option value="-" selected="selected">-</option>
                <?php
                if($user->leaving_date == null) {
                  $dd = 0;
                } else {
                  $dd = $user->leaving_date->format('d');
                }
                for ($d=1; $d <= 31; $d++) {
                  if($d == intval($dd)) {
                    print('<option value="' . $d . '" selected="selected">' . $d . '</option>');
                  } else {
                    print('<option value="' . $d . '">' . $d . '</option>');
                  }
                } ?>
              </select>
              日
              </li>
            </ul>



            <h2 class="any">生年月日</h2>
            <ul class="pulldown">
              <li>
                <select id="year04" class="time" name="birthday_year_yy">
                  <option value="-" selected="selected">-</option>
                  <?php
                  if($user->birth_date == null) {
                    $yy = 0;
                  } else {
                    $yy = $user->birth_date->format('Y');
                  }
                  for ($y=2016; $y >= 1900; $y--) {
                    if($y == intval($yy)) {
                      print('<option value="' . $y . '" selected="selected">' . $y . '</option>');
                    } else {
                      print('<option value="' . $y . '">' . $y . '</option>');
                    }
                  } ?>
                </select>
                年
              </li>
              <li>
              <select id="month04" class="time" name="birthday_month_mm">
                <option value="-" selected="selected">-</option>
                <?php
                if($user->birth_date == null) {
                  $mm = 0;
                } else {
                  $mm = $user->birth_date->format('m');
                }
                for ($m=1; $m <= 12; $m++) {
                  if($m == intval($mm)) {
                    print('<option value="' . $m . '" selected="selected">' . $m . '</option>');
                  } else {
                    print('<option value="' . $m . '">' . $m . '</option>');
                  }
                } ?>
              </select>
              月
              </li>
              <li>
              <select id="day04" class="time" name="birthday_day_dd">
                <option value="-" selected="selected">-</option>
                <?php
                if($user->birth_date == null) {
                  $dd = 0;
                } else {
                  $dd = $user->birth_date->format('d');
                }
                for ($d=1; $d <= 31; $d++) {
                  if($d == intval($dd)) {
                    print('<option value="' . $d . '" selected="selected">' . $d . '</option>');
                  } else {
                    print('<option value="' . $d . '">' . $d . '</option>');
                  }
                } ?>
              </select>
              日
              </li>
            </ul>

            <h2 class="any">血液型</h2>
            <div class="blood_type">
              <select id="blood_type" class="blood_type" name="blood_type">
                <option value="-" selected="selected">-</option>
                <?php if( $user->blood_type == "A") { ?>
                  <option value="A" selected="selected">A型</option>
                <?php } else { ?>
                  <option value="A">A型</option>
                <?php } ?>
                <?php if( $user->blood_type == "B") { ?>
                  <option value="B" selected="selected">B型</option>
                <?php } else { ?>
                  <option value="B">B型</option>
                <?php } ?>
                <?php if( $user->blood_type == "O") { ?>
                  <option value="O" selected="selected">O型</option>
                <?php } else { ?>
                  <option value="O">O型</option>
                <?php } ?>
                <?php if( $user->blood_type == "AB") { ?>
                  <option value="AB" selected="selected">AB型</option>
                <?php } else { ?>
                  <option value="AB">AB型</option>
                <?php } ?>
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
  </form>



  <?php
  echo $this->Form->create($user,['type' => 'file']);
  echo $this->Form->file('photo');
  echo $this->Form->button('登録', ['class' => 'btn']);
  echo $this->Form->end();
  ?>


  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu') ?>
<!--▲ユーザーメニュー-->

</body>

</html>
