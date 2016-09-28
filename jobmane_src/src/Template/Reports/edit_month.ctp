
<?php $this->assign('title', '月報編集 | 業務管理システム') ?>

<?php $this->start('meta') ?>
<meta name="description" content="月報編集 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/monthly_report_edit.css" media="all" />
<?php $this->end() ?>

<script language="javascript" type="text/javascript">

  function swDis() {
    fObj = document.form_post;
    fObj.etc_txt.disabled = (fObj.pay[2].checked) ? false : true ;
  }

  function dateDis() {
    $('#day').val('-');
    $('#month').val('-');
  }

  $(document).ready(function() {
    $('#a-submit').click(function(){
      $(".form_post").submit();
        return false;
      });
  })
</script>


<style>
dl.id {
  padding-top: 10px !important;
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
  margin-bottom: -1px;
  padding-top: 6px;
  padding-bottom: 6px;
  padding-right: 1px;
  padding-left: 10px;
  margin-bottom: 12px;
  list-style-type: none;
  vertical-align: middle;
}

//.flash {
  //width: 80%;
  //margin-right: auto;
  //margin-left: auto;
  //padding-top: 40px;
  //p/adding-bottom: 20px;
//}
.errorsss {
  width: 98%;
  display: block;
  font-size: 14px;
  font-weight: bolder;
  line-height: 1.5;
  background-color: #ffd9d9;
  border: solid 1px #ff3f3f;
  color: #ff3f3f;
  text-align: left;
  margin-bottom: -1px;
  padding-top: 6px;
  padding-bottom: 6px;
  padding-right: 1px;
  padding-left: 10px;
  list-style-type: none;
  vertical-align: middle;
}
.error li:before {
  content: "・";
}
</style>


<!--contentns-->
<!--大枠-->
  <section id="body">
    <form id="form_post" class="form_post" name="form_post" action='/reports/edit-month/<?= $monthlyReport->user_id ?>' method='post'>

      <div class="monthly_report_edit">
        <div class="inbox">
          <h1>月報編集</h1>

          <dl class="flash">
            <?= $this->Flash->render() ?>
          </dl>

<?php
        if(isset($errors)):
          $fields = 'bonus';
          echo $this->Consumer->getErrorHtml((isset($errors) ? $errors : ''), $fields, true);
        endif;
 ?>

           <h2 class="client_title"><?= $monthlyReport->client->name ?></h2>

          <dl class="user">
            <dd>
          <?= $monthlyReport->year ?>/<?= sprintf("%'02d",$monthlyReport->month) ?><br /><?= $user->name ?> さんの月報
            </dd>
          </dl>

          <h3 class="sub_title">賃金</h3>

          <ul class="radio">
            <li>
              <label for="daily_wage">日給</label><input id="daily_wage" onClick="swDis()" type="radio" name="pay" value="日給"
                  <?php if($monthlyReport->pay == null || $monthlyReport->pay == "日給" ){echo 'checked="checked"';} ?>>
            </li>
            <li>
              <label for="monthly_salary">月給</label><input id="monthly_salary" onClick="swDis()" type="radio" name="pay"
                value="月給" <?php if($monthlyReport->pay == "月給" ){echo 'checked="checked"';} ?>>
            </li>
            <li>
              <label for="other">その他</label><input id="other" onClick="swDis()" type="radio" name="pay" value="その他" <?php if($monthlyReport->pay == "その他" ){echo 'checked="checked"';} ?>>
            </li>
          </ul>

          <h4 class="sub_copy">※「その他」を選んだ場合のみ入力</h4>
          <div class="etc_txt">
            <input class="etc_txt" id="etc_txt" type="text" name="pay_etc" size="24" <?php if($monthlyReport->pay == null || $monthlyReport->pay != "その他"){echo 'disabled="disabled"';} ?> value="<?= $monthlyReport->pay_etc ?>">
          </div>

          <h3 class="sub_title">今月度賞与</h3>

          <ul class="radio">
            <li>
              <label for="bonus_on">有</label><input id="bonus_on" type="radio" name="bonus" value="有"
                      <?php if($monthlyReport->bonus == "有"){echo 'checked="checked"';} ?>>
            </li>
            <li>
              <label for="bonus_off">無</label><input id="bonus_off"  onClick="dateDis()" type="radio" name="bonus" value="無"
                      <?php if($monthlyReport->bonus == null || $monthlyReport->bonus == "無" ){echo 'checked="checked"';} ?>>
            </li>
          </ul>

          <ul class="time">
            <li>
              <select id="month" class="time" name="month_mm">
                <option value="-" selected="selected">-</option>
                <?php
                if($monthlyReport->bonus_date == null) {
                  $mm = -1;
                } else {
                  $mm = $monthlyReport->bonus_date->format('m');
                }
                for ($m=1; $m <= 12; $m++) {
                  $sm = sprintf("%'.02d", $m);
                  if($m == intval($mm)) {
                    print('<option value="' . $m . '" selected="selected">' . $sm . '</option>');
                  } else {
                    print('<option value="' . $m . '">' . $sm . '</option>');
                  }
                } ?>
              </select>
            月
            </li>
            <li>
            <select id="day" class="time" name="day_dd">
              <option value="-" selected="selected">-</option>
              <?php
              if($monthlyReport->bonus_date == null) {
                $dd = -1;
              } else {
                $dd = $monthlyReport->bonus_date->format('d');
              }
              for ($d=1; $d <= 31; $d++) {
                $sd = sprintf("%'.02d", $d);
                if($d == intval($dd)) {
                  print('<option value="' . $d . '" selected="selected">' . $sd . '</option>');
                } else {
                  print('<option value="' . $d . '">' . $sd . '</option>');
                }
              } ?>
            </select>
            日
            </li>
          </ul>

          <div class="save_btn">
            <a href="" id="a-submit">保存して一覧へ戻る</a>
          </div>


        </div>
      </div>
    </form>
  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu') ?>
<?= $this->element('slidemenu_false') ?>
<!--▼ユーザーメニュー-->
