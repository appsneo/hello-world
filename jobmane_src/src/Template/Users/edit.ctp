
<?php $this->assign('title', 'ユーザー管理 詳細 | 業務管理システム') ?>

<?php $this->start('meta') ?>
<meta name="description" content="ユーザー管理 詳細 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_user_detail.css" media="all" />
<style>
dl.id {
  padding-top: 10px !important;
}
<style>
<style>
.success, .error {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
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
  background-color: #ffd9d9;
  border: solid 1px #ff3f3f;
  color: #ff3f3f;
}
.success {
    background-color: #f0f8ff;
    border: solid 1px #0000cd;
    color: #0000cd;
  }
.error li:before, .success li:before {
  content: "・";
}

div.input ul.error, ul.success,dl.flash ul.success {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  text-align: left;
  margin-top: -10px;
  margin-bottom: 20px;
  padding-top: 6px;
  padding-bottom: 6px;
  padding-right: 1px;
  padding-left: 10px;
  list-style-type: none;
  vertical-align: middle;
}
ul.errorxx {
  background-color: #ffd9d9;
  border: solid 1px #ff3f3f;
  color: #ff3f3f;
}
ul.success, dl.flash ul.success {
    background-color: #f0f8ff;
    border: solid 1px #0000cd;
    color: #0000cd;
}
.error li:before, .error li:before{
  content: "・";
}
</style>
<?php $this->end() ?>


<script type="text/javascript">

function entryChange(){
  if(document.getElementById('changeSelect')){
    id = document.getElementById('changeSelect').value;

    //社長選択
    if(id == 'president'){
      //フォーム
      document.getElementById('president_box').style.display = "block";
    }

    //監督選択　※今回のフェーズでは未使用
    else if(id == 'directer'){
      //フォーム
      document.getElementById('president_box').style.display = "none";
    }
}

$(function(){
    var setFileInput = $('#select-file');

    setFileInput.each(function(){
        var selfFile = $(this),
        selfInput = $(this).find('input[type=file]');
        selfInput.change(function(){
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
            //          alert('image remove.');
                        selfImg.remove();
                        return;
                    }
                }
            }
        });
    });
});

$(document).ready(function() {

//alert('doc ready');

   $('#a_pass').click(function(){
     var action = $("#a_pass").attr('href');
  //   alert(action);
     $(".form-post").attr('action', action);
     $(".form-post").submit();
  //  alert('Sign new href executed.');
    return false;
   });

  $("#go_save").click(function(){
    $(".form-post").submit();
    return false;
  });

  $("#go_materials").click(function(){
//    alert('materials');
//    var id = $('#company_id').val();
  //  alert(id);
  //    $("#form-post").attr('action', "/materials/index/" + id);
//alert($("#form-post").attr('action'));
     $("#next").val("materials");
     $("#form-post").submit();
      return false;
  });

  $("#go_clients").click(function(){
//    var id = $('#company_id').val();
  //  $("#form-post").attr('action', "/clients/index/" + id);
//alert($("#form-post").attr('action'));
      $("#next").val("clients");
      $("#form-post").submit();
      return false;
  });

    $("#go_categories").click(function(){
    //  var id = $('#company_id').val();
      //$("#form-post").attr('action', "/categories/index/" + id);
//alert($("#form-post").attr('action'));
        $("#next").val("categories");
        $("#form-post").submit();
        return false;
    });

});

}

//オンロードさせ、リロード時に選択を保持
window.onload = entryChange;
</script>

<!--contentns-->
<!--大枠-->
  <section id="body">
    <form id="form-material" class="form-material" name="form-material" action='/materials/index/' method='post'>
      <input type="hidden" name="company_id" value="<?= $user->company_id ?>" ?>
      <input type="hidden" name="president_id" value="<?= $user->id ?>" ?>
    </form>

    <?php
//      if( $from == 'edit'):
  //      $action = '/users/edit/' . $user->id;
    //  elseif( $from == 'add'):
      //  $action = '/users/add';
    //  elseif( $from == 'edit-president'):
      //  $action = '/users/edit-president/' . $user->id;
    //  elseif( $from == 'add-president'):
      //  $action = '/users/add-president';
    //  endif;
    ?>

    <form id="form-post" enctype="multipart/form-data" accept-charset="utf-8"  class="form-post" name="form-post" action='<?= $next ?>' method='post'>

      <input type="hidden" name="company_id" id="company_id" value="<?= $user->company_id ?>" ?>
      <input type="hidden" name="president_id" id="president_id" value="<?= $user->id ?>" ?>
    <div class="manager_user_detail">
      <div class="inbox">
        <h1>ユーザー管理 詳細</h1>

          <div class="inbox2">

            <ul class="error" style="display:none;">
              <li>お名前は入力必須です</li>
              <li>ユーザーIDは入力必須です</li>
              <li>メールアドレスは入力必須です</li>
              <li>会社名は入力必須です</li>
              <li>所定勤務時間は入力必須です</li>
              <li>早出手当は入力必須です</li>
              <li>残業手当は入力必須です</li>
            </ul>

            <?= $this->Flash->render() ?>

    <?php
            if(isset($errors)):
              $fields = 'save,name,user_id,password,password_check,email,company_name,' .
                        'category,money,start,end,address,charge,time1,minute1,time2,minute2,rest_minutes,select_person,' .
                        'office_hours,early_shift_allowance,early_shift_allowance2,company,president,' .
                        'medical_checkup_year_yy,joined_year_yy,leaving_year_yy,birthday_year_yy,hourly_pay,hourly_pay2';
              echo $this->Consumer->getErrorHtml((isset($errors) ? $errors : ''), $fields, true);
            endif;
     ?>

            <h2 class="sub_title">お名前<span class="required">必須</span></h2>
            <input class="text" type="text" name="name" value="<?= $user->name ?>" size="24" />


            <h2 class="sub_title">ユーザーID<span class="required">必須</span></h2>
            <input class="text" type="text" name="user_id" value="<?= $user->user_id ?>" size="24" />

<?php if( $mode == 'edit' || $mode == 'edit-president') {?>
            <p class="password_change">
              <a href="/users/password/<?= $user->id ?>"  id="a_pass">⇒パスワードの変更はこちら</a>
            </p>
<?php } else { ?>
            <ul class="password clfx">
              <li>
                <h2 class="sub_title">パスワード<span class="required">必須</span></h2>
                <input class="password" type="password" name="password" size="24" />
              </li>
              <li>
                <h2 class="sub_title">パスワード<span class="small">再入力</span><span class="required">必須</span></h2>
                <input class="password" type="password" name="password_check" size="24" value="" />
              </li>
            </ul>
<?php } ?>

            <h2 class="sub_title">メールアドレス<span class="required">必須</span></h2>
            <input class="text" type="text" name="email" value="<?= $user->email ?>" size="24" />

            <div class="row clfx">

              <div class="left_box">
                <dl class="authority">
                  <dt>権限：</dt>
                  <dd>
                    <select id="changeSelect" class="authority_select" name="role" onchange="entryChange();" size="1">
            <?php if($mode == 'edit-president' || $mode == 'add-president'): ?>
                      <option value="president" selected="selected">管理者</option>
            <?php else: ?>
                      <option value="operator" selected="selected">作業員</option>
            <?php endif; ?>
                      <!--option value="directer">監督</option-->
                    </select>
                  </dd>
                </dl>
              </div>

              <div class="right_box">
                <dl class="account_status">
                  <dt>
                    <input id="account_status" class="account_status" type="checkbox" name="account_status" value="account_on"
                            <?php if($user->status){ echo 'checked="checked"';}?> />
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

            <!--▼社長入力項目-->
    <?php if($mode == 'edit-president' || $mode == 'add-president' || $mode == 'index-president'): ?>

            <div id="president_box">
            <h2 class="designated_title">会社情報</h2>

              <h3 class="sub_title">会社名<span class="required">必須</span></h3>
              <input class="company_text" type="text" name="company_name" value="<?= $company->name ?>" size="24" />

              <h3 class="sub_title">所定勤務時間<span class="required">必須</span></h3>

                <div class="inbox3">

                  <h4 class="sub_title">始業時間</h4>

                  <ul class="time">
                    <li>
                      <select class="time_select" name="time1" size="1">
                        <option value="-" selected="selected">-</option>
                        <?php
                        if($company->start_time == null) {
                          $hh = -1;
                        } else {
                          $hh = $company->start_time->format('H');
                        }
                        for ($h=0; $h <= 23; $h++) {
                          $sh = sprintf("%'.02d", $h);
                          if($h == intval($hh)) {
                            print('<option value="' . $sh . '" selected="selected">' . $sh . '</option>');
                          } else {
                            print('<option value="' . $sh . '">' . $sh . '</option>');
                          }
                        } ?>
                      </select>
                      時
                    </li>
                    <li>
                      <select class="time_select" name="minute1" size="1">
                        <option value="-" selected="selected">-</option>
                        <?php
                        if($company->start_time == null) {
                          $mm = -1;
                        } else {
                          $mm = $company->start_time->format('i');
                        }
                        for ($m=0; $m <= 50; $m=$m+10) {
                          $sm = sprintf("%'.02d", $m);
                          if($m == intval($mm)) {
                            print('<option value="' . $sm . '" selected="selected">' . $sm . '</option>');
                          } else {
                            print('<option value="' . $sm . '">' . $sm . '</option>');
                          }
                        } ?>
                      </select>
                        分
                    </li>
                  </ul>


                  <h4 class="sub_title">終業時間</h4>

                  <ul class="time">
                    <li>
                      <select class="time_select" name="time2" size="1">
                        <option value="-" selected="selected">-</option>
                        <?php
                        if($company->end_time == null) {
                          $hh = -1;
                        } else {
                          $hh = $company->end_time->format('H');
                        }
                        for ($h=0; $h <= 23; $h++) {
                          $sh = sprintf("%'.02d", $h);
                          if($h == intval($hh)) {
                            print('<option value="' . $sh . '" selected="selected">' . $sh . '</option>');
                          } else {
                            print('<option value="' . $sh . '">' . $sh . '</option>');
                          }
                        } ?>
                      </select>
                      時
                    </li>
                    <li>
                      <select class="time_select" name="minute2" size="1">
                        <option value="-" selected="selected">-</option>
                        <?php
                        if($company->end_time == null) {
                          $mm = -1;
                        } else {
                          $mm = $company->end_time->format('i');
                        }
                        for ($m=0; $m <= 50; $m=$m+10) {
                          $sm = sprintf("%'.02d", $m);
                          if($m == intval($mm)) {
                            print('<option value="' . $sm . '" selected="selected">' . $sm . '</option>');
                          } else {
                            print('<option value="' . $sm . '">' . $sm . '</option>');
                          }
                        } ?>
                      </select>
                        分
                    </li>
                  </ul>

                  <h4 class="sub_title">休憩時間</h4>

                  <ul class="time">
                    <li>
                      <select class="time_select" name="rest_minutes" size="1">
                        <option value="-" selected="selected">-</option>
                        <?php
                        if($company->rest_minutes == '-' || $company->rest_minutes == null) {
                          $mm = -1;
                        } else {
                          $mm = $company->rest_minutes;
                        }
                        for ($m=0; $m <= 200; $m=$m+5) {
                          $sm = sprintf("%'.02d", $m);
                          if($m == intval($mm)) {
                            print('<option value="' . $sm . '" selected="selected">' . $sm . '</option>');
                          } else {
                            print('<option value="' . $sm . '">' . $sm . '</option>');
                          }
                        } ?>
                      </select>
                        分
                    </li>
                  </ul>

                </div>

              <h3 class="sub_title">早出手当<span class="required">必須</span></h3>

              <div class="inbox3">
                <ul class="radio">
                  <li>
                    <label for="early_shift_allowance_on">有</label><input id="early_shift_allowance_on" type="radio" name="early_shift_allowance" value="有" <?php if($company->shift_exist) { ?>checked="checked"<?php } ?>>
                  </li>
                  <li>
                    <label for="early_shift_allowance_off">無</label><input id="early_shift_allowance_off" type="radio" name="early_shift_allowance" value="無"<?php if(!$company->shift_exist) { ?>checked="checked"<?php } ?>>
                  </li>
                </ul>

                  <ul class="time">
                    <li>
                      <select class="time_select" name="time3" size="1">
                        <option value="-" selected="selected">-</option>
                        <?php
                        if($company->shift_time == null) {
                          $hh = -1;
                        } else {
                          $hh = $company->shift_time->format('H');
                        }
                        for ($h=0; $h <= 23; $h++) {
                          $sh = sprintf("%'.02d", $h);
                          if($h == intval($hh)) {
                            print('<option value="' . $sh . '" selected="selected">' . $sh . '</option>');
                          } else {
                            print('<option value="' . $sh . '">' . $sh . '</option>');
                          }
                        } ?>
                      </select>
                      時
                    </li>
                    <li>
                      <select class="time_select" name="minute4" size="1">
                        <option value="-" selected="selected">-</option>
                        <?php
                        if($company->shift_time == null) {
                          $mm = -1;
                        } else {
                          $mm = $company->shift_time->format('i');
                        }
                        for ($m=0; $m <= 55; $m=$m+5) {
                          $sm = sprintf("%'.02d", $m);
                          if($m == intval($mm)) {
                            print('<option value="' . $sm . '" selected="selected">' . $sm . '</option>');
                          } else {
                            print('<option value="' . $sm . '">' . $sm . '</option>');
                          }
                        } ?>
                      </select>
                        分 まで
                    </li>
                  </ul>

                  <div class="hourly_pay">
                    <input class="hourly_pay js-characters-change" type="text" name="hourly_pay" value="<?= number_format($company->shift_pay) ?>" size="24" pattern="\d*" />円 / 時間
                    <span class="inline-block">(半角数字のみ ,カンマもなし)</span>
                  </div>

              </div>

              <h3 class="sub_title">残業手当<span class="required">必須</span></h3>

              <div class="inbox3">
                <ul class="radio">
                  <li>
                    <label for="early_shift_allowance_on2">有</label><input id="early_shift_allowance_on2" type="radio" name="early_shift_allowance2" value="有" <?php if($company->overtime_exist) { ?>checked="checked"<?php } ?>>
                  </li>
                  <li>
                    <label for="early_shift_allowance_off2">無</label><input id="early_shift_allowance_off2" type="radio" name="early_shift_allowance2" value="無"<?php if(!$company->overtime_exist) { ?>checked="checked"<?php } ?>>
                  </li>
                </ul>

                  <ul class="time">
                    <li>
                      <select class="time_select" name="time4" size="1">
                        <option value="-" selected="selected">-</option>
                        <?php
                        if($company->overtime_time == null) {
                          $hh = -1;
                        } else {
                          $hh = $company->overtime_time->format('H');
                        }
                        for ($h=0; $h <= 23; $h++) {
                          $sh = sprintf("%'.02d", $h);
                          if($h == intval($hh)) {
                            print('<option value="' . $sh . '" selected="selected">' . $sh . '</option>');
                          } else {
                            print('<option value="' . $sh . '">' . $sh . '</option>');
                          }
                        } ?>
                      </select>
                      時
                    </li>
                    <li>
                      <select class="time_select" name="minute5" size="1">
                        <option value="-" selected="selected">-</option>
                        <?php
                        if($company->overtime_time == null) {
                          $mm = -1;
                        } else {
                          $mm = $company->overtime_time->format('i');
                        }
                        for ($m=0; $m <= 55; $m=$m+5) {
                          $sm = sprintf("%'.02d", $m);
                          if($m == intval($mm)) {
                            print('<option value="' . $sm . '" selected="selected">' . $sm . '</option>');
                          } else {
                            print('<option value="' . $sm . '">' . $sm . '</option>');
                          }
                        } ?>
                      </select>
                        分 以降
                    </li>
                  </ul>

                  <div class="hourly_pay">
                    <input class="hourly_pay js-characters-change" type="text" name="hourly_pay2" value="<?= number_format($company->overtime_pay) ?>" size="24" pattern="\d*" />円 / 時間
                    <span class="inline-block">(半角数字のみ ,カンマもなし)</span>
                  </div>

                </div>


                <h3 class="sub_title2">使用部材</h3>

                <div class="inbox3">

                  <ul class="list">
                    <?php foreach ($materials as $material): ?>
                          <li><?= $material->name ?></li>
                    <?php endforeach; ?>
                  </ul>

                  <div class="go_edit_btn" id="go_materials">
                      <a href="" >使用部材の編集</a>
                  </div>

                  <p class="atte">※こちらのボタンを押すと現在編集中の内容は自動的に保存されます。</p>
                  <p class="atte">※入力必須項目が未入力の場合は、次の画面へ進めませんので、必須項目はご入力の上ボタンを押してください。</p>
                  <input type="hidden" id="action" name="action" value="<?= $user->action ?>" />
                  <input type="hidden" id="next" name="next" value="<?= $user->next ?>" />

                </div>

               <h3 class="sub_title2">取引先</h3>

                <div class="inbox3">

                  <ul class="list">
                    <?php foreach ($clients as $client): ?>
                          <li><?= $client->name ?></li>
                    <?php endforeach; ?>
                  </ul>

                  <div class="go_edit_btn" id="go_clients">
                    <a href="">取引先の編集</a>
                  </div>

                  <p class="atte">※こちらのボタンを押すと現在編集中の内容は自動的に保存されます。</p>
                  <p class="atte">※入力必須項目が未入力の場合は、次の画面へ進めませんので、必須項目はご入力の上ボタンを押してください。</p>

                </div>


                <h3 class="sub_title2">作業種別</h3>

                <div class="inbox3">

                  <ul class="list">
              <?php foreach ($categories as $category): ?>
                    <li><?= $category->name ?></li>
              <?php endforeach; ?>
                  </ul>

                  <div class="go_edit_btn" id="go_categories">
                    <a href="">作業種別の編集</a>
                  </div>

                  <p class="atte">※こちらのボタンを押すと現在編集中の内容は自動的に保存されます。</p>
                  <p class="atte">※入力必須項目が未入力の場合は、次の画面へ進めませんので、必須項目はご入力の上ボタンを押してください。</p>

                </div>


            </div>
            <!--▲社長入力項目-->
        <?php endif; ?>

            <div id="avatar">
                <img id="preview-photo" class="main_img" src="/users/contents/<?= $user->id ?>" alt="" width="120" />
            </div>
            <div id="select-file">
              <input type="file" id="select-photo" class="file" name="photo" id="photo" onchangexxx="imgUpload(this)" />
            </div>

            <h2 class="any">最新健康診断年月日</h2>
            <ul class="pulldown">
              <li>
                <select id="year01" class="time" name="medical_checkup_year_yy">
                  <option value="-" selected="selected">-</option>
                  <?php
                  $this->log($user->medical_checkup_date, 'debug');
                  $this->log($user->birth_date, 'debug');

                  if($user->medical_checkup_date == null || $user->medical_checkup_date == "" ) {
                    $yy = 0;
                  } else {
                    $yy = $user->medical_checkup_date->format('Y');
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
                if($user->medical_checkup_date == null) {
                  $mm = -1;
                } else {
                  $mm = $user->medical_checkup_date->format('m');
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
                if($user->medical_checkup_date == null) {
                  $dd = -1;
                } else {
                  $dd = $user->medical_checkup_date->format('d');
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
                    $yy = -1;
                  } else {
                    $yy = $user->joined_date->format('Y');
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
              <select id="month02" class="time" name="joined_month_mm">
                <option value="-" selected="selected">-</option>
                <?php
                if($user->joined_date == null) {
                  $mm = -1;
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
                  $dd = -1;
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
                    $yy = -1;
                  } else {
                    $yy = $user->leaving_date->format('Y');
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
              <select id="month03" class="time" name="leaving_month_mm">
                <option value="-" selected="selected">-</option>
                <?php
                if($user->leaving_date == null) {
                  $mm = -1;
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
                  $dd = -1;
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
                    $yy = -1;
                  } else {
                    $yy = $user->birth_date->format('Y');
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
              <select id="month04" class="time" name="birthday_month_mm">
                <option value="-" selected="selected">-</option>
                <?php
                if($user->birth_date == null) {
                  $mm = -1;
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
                  $dd = -1;
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
        <?php if( $mode == 'edit' || $mode == 'edit-president') {?>
              <a href="" id="go_save">更新する</a>
        <?php } else { ?>
              <a href="" id="go_save">登録する</a>
        <?php } ?>
            </div>

          </div>
      </div>
    </div>
  </form>
  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu') ?>
<?= $this->element('slidemenu_false') ?>
<!--▲ユーザーメニュー-->
