
<?php $this->assign('title', '月報 | 業務管理システム') ?>

<?php $this->start('meta') ?>
<meta name="description" content="月報 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/monthly_report_print.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/print.css" media="print" />
<?php $this->end() ?>

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

<!--contentns-->
<!--大枠-->
  <section id="body">


    <div class="print_btn clfx">
      <p class="number">月報No.<?= sprintf('%07d', $monthlyReport->id) ?></p>
      <a  href="javascript:void(0)" onclick="window.print();return false;"><img src="/img/common/print_pict.png" alt="" width="24" />月報を印刷</a>
    </div>

    <div class="monthly_report_print">
      <div class="inbox">

          <?= $this->Flash->render() ?>

        <!--▼A4 1ページ分-->
        <section class="a4-print">
        <div class="title">
          <span class="copy">作業月報</span>
          <span class="year"><?= $monthlyReport->bonus_date_jp ?>年</span>
          <span class="month"><?= $monthlyReport->month ?>月度</span>
        </div>

        <table class="info" width="100%">
          <tr>
            <th>受注元工事店名</th>
            <td>

<?php
//foreach ($reports as $report) {
//  $cname = $report->project->client_id;
//  $secondary  = $report->project->secondary;
//  $ctname = $report->project->category_id;
//}
//if($project->single) {
  //$cname = $project->client_name;
//} else {
  //$cname = $project->client->name;
//}
?>
              <?= $client_name ?></td>
            <th>協力業者名</th>
            <td><?= $secondary_names ?></td>
          </tr>
          <tr>
            <th>現場従事者氏名</th>
            <td><?= $user->name ?></td>
            <th>工事種</th>
            <td>
              <?php
              //if($project->single) {
  //              $ctname = '単発プロジェクト';   //project->category_name;
    //          } else {
      //          $ctname = $project->category->name;
              //}
               ?>


              <?= $category_names ?></td>
          </tr>
          <tr>
            <th>従事者区分</th>
            <td colspan="3">作業員</td>
          </tr>
        </table>

        <table class="detail" width="100%">
          <tr>
            <th colspan="5">労働日数（他社・自社を含む）</th>
            <th>賃金</th>
            <th>早出手当<?php if($company->shift_exist==1){echo '有り';}else{echo '無し';}?></th>
            <th>今月度賞与支給</th>
          </tr>
          <tr>
            <th>①通常出勤</th>
            <th>②有給休暇</th>
            <th>③休日出勤</th>
            <th colspan="2">合計①+②</th>
            <td rowspan="3">
              <?php if($monthlyReport->pay == "その他")
              { echo $monthlyReport->pay_etc;}
              else {echo $monthlyReport->pay;} ?></td>
            <td>
              <?php
                if($company->shift_exist==0):
                  {echo '-';}
                else:
                  {echo $company->shift_time->format('G時i分') . 'まで ' . number_format($company->shift_pay) . '円/時間';}
                endif;
              ?>
            </td>
            <td rowspan="3">
              <?php
              if($monthlyReport->bonus == "無"){echo "無し";}
                else{echo "有り" . '(' . $monthlyReport->bonus_date->format('n月j日') . ')';}
              ?>
            </td>
          </tr>
          <tr>
            <td><?= $normal ?>日</td>
            <td><?= $salaried ?>日</td>
            <td><?= $holiday_work ?>日</td>
            <td colspan="2"><?= $total ?>日</td>
            <th>残業手当<?php if($company->overtime_exist==1){echo '有り';}else{echo '無し';}?></th>
          </tr>
          <tr>
            <th>所定<br />勤務時間</th>
            <td colspan="2"><?php if($company->start_time){echo $company->start_time->format('G:i');} ?>～<?php if($company->end_time){echo $company->end_time->format('G:i');} ?></td>
            <th>休憩<br />時間</th>
            <td><?= $company->rest_minutes ?>分</td>
            <td>
              <?php
                if($company->overtime_exist==0):
                  {echo '-';}
                else:
                  {echo $company->overtime_time->format('G時i分') . '以降 ' . number_format($company->overtime_pay) . '円/時間';}
                endif;
              ?>
            </td>
          </tr>
          <tr>
            <td colspan="8">1日単価＝（基本給+毎月決まって支給される手当）÷　労働日数</td>
          </tr>
        </table>

        <table class="report_list" width="100%">
          <tr>
            <th rowspan="2" width="6%">月/日</th>
            <td colspan="2">新築工事現場の</td>
            <td colspan="3">①10分単位<br />②移動時間は後現場へ</td>
            <td colspan="3">手当等を支給した場合のみ記入</td>
            <th rowspan="2" width="5%">他の<br />仕事</th>
            <th rowspan="2" width="12%">備考</th>
          </tr>
          <tr>
            <th width="9%">契約書番号</th>
            <th width="20%">物件名（フルネーム）</th>
            <th width="8%">入場時刻</th>
            <th width="8%">出場時刻</th>
            <th width="8%">作業時間</th>
            <th width="8%">早出時間</th>
            <th width="8%">残業時間</th>
            <th width="7%">手当等</th>
          </tr>
          <?php
            $pos = 0;
            foreach ($reports as $report): ?>
          <tr>
            <td width="6%"><?php if($report->work_date){echo $report->work_date->format('n/d');} ?></td>
            <td width="9%"><?= $report->pr['num'] ?></td>
            <td width="20%">
              <?php echo $this->Text->truncate($report->pr['project_name'],
                20, [
                  'ending' => '...',
                  'exact' => false,
                  'html' => false
                ]);
             ?>
            <td width="8%"><?php if($report->start_time){echo $report->start_time->format('G:i');} ?></td>
            <td width="8%"><?php if($report->end_time){echo $report->end_time->format('G:i');} ?></td>
            <td width="8%"><?= $report->diffTime ?></td>
            <td width="8%"><?= $report->shiftTime ?></td>
            <td width="8%"><?= $report->overTime ?></td>
            <td width="7%"><?= $report->allowance ?></td>
            <td width="5%"><?php if( $report->other_work == 1){echo '有り';} ?></td>
            <td width="12%">
              <p class="ellipsis"><?php if($report->holiday_work){echo '休日出勤';} ?><?php if($report->salaried){echo '有給休暇';} ?><?= $report->note ?></p></td>
          </tr>
        <?php
            $pos++;
            if($pos > 31) {break;}
          endforeach;

      if($pos < 31):
        for ($i=$pos; $i <= 31; $i++): ?>
          <tr>
            <td width="6%">　</td>
            <td width="9%">　</td>
            <td width="20%">　</td>
            <td width="8%">　</td>
            <td width="8%">　</td>
            <td width="8%">　</td>
            <td width="8%">　</td>
            <td width="8%">　</td>
            <td width="7%">　</td>
            <td width="5%">　</td>
            <td width="12%">　</td>
          </tr>
      <?php
        endfor;
      endif; ?>

      </table>
      </section>
      <!--▲A4 1ページ分-->



      <!--▼A4 2ページ分-->
      <section class="a4-print <?php if(count($reports) <= 31) { echo 'hidden';} ?>" >
      <div class="title">
        <span class="copy">作業月報</span>
        <span class="year"><?= $monthlyReport->bonus_date_jp ?>年</span>
        <span class="month"><?= $monthlyReport->month ?>月度</span>
      </div>

      <table class="info" width="100%">
        <tr>
          <th>受注元工事店名</th>
          <td>


<?php
//foreach ($reports as $report) {
//  $cname = $report->project->client_id;
//  $secondary  = $report->project->secondary;
//  $ctname = $report->project->category_id;
//}
//if($project->single) {
//$cname = $project->client_name;
//} else {
//$cname = $project->client->name;
//}
?>
            <?= $client_name ?></td>
          <th>協力業者名</th>
          <td><?= $secondary_names ?></td>
        </tr>
        <tr>
          <th>現場従事者氏名</th>
          <td><?= $user->name ?></td>
          <th>工事種</th>
          <td>
            <?php
            //if($project->single) {
//              $ctname = '単発プロジェクト';   //project->category_name;
  //          } else {
    //          $ctname = $project->category->name;
            //}
             ?>


            <?= $category_names ?></td>
        </tr>
        <tr>
          <th>従事者区分</th>
          <td colspan="3">作業員</td>
        </tr>
      </table>

      <table class="detail" width="100%">
        <tr>
          <th colspan="5">労働日数（他社・自社を含む）</th>
          <th>賃金</th>
          <th>早出手当<?php if($company->shift_exist==1){echo '有り';}else{echo '無し';}?></th>
          <th>今月度賞与支給</th>
        </tr>
        <tr>
          <th>①通常出勤</th>
          <th>②有給休暇</th>
          <th>③休日出勤</th>
          <th colspan="2">合計①+②</th>
          <td rowspan="3">
            <?php if($monthlyReport->pay == "その他")
            { echo $monthlyReport->pay_etc;}
            else {echo $monthlyReport->pay;} ?></td>
          <td>
            <?php
              if($company->shift_exist==0):
                {echo '-';}
              else:
                {echo $company->shift_time->format('G時i分') . 'まで ' . number_format($company->shift_pay) . '円/時間';}
              endif;
            ?>
          </td>
          <td rowspan="3">
            <?php
            if($monthlyReport->bonus == "無"){echo "無し";}
              else{echo "有り" . '(' . $monthlyReport->bonus_date->format('n月j日') . ')';}
            ?>
          </td>
        </tr>
        <tr>
          <td><?= $normal ?>日</td>
          <td><?= $salaried ?>日</td>
          <td><?= $holiday_work ?>日</td>
          <td colspan="2"><?= $total ?>日</td>
          <th>残業手当<?php if($company->overtime_exist==1){echo '有り';}else{echo '無し';}?></th>
        </tr>
        <tr>
          <th>所定<br />勤務時間</th>
          <td colspan="2"><?php if($company->start_time){echo $company->start_time->format('G:i');} ?>～<?php if($company->end_time){echo $company->end_time->format('G:i');} ?></td>
          <th>休憩<br />時間</th>
          <td><?= $company->rest_minutes ?>分</td>
          <td>
            <?php
              if($company->overtime_exist==0):
                {echo '-';}
              else:
                {echo $company->overtime_time->format('G時i分') . '以降 ' . number_format($company->overtime_pay) . '円/時間';}
              endif;
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="8">1日単価＝（基本給+毎月決まって支給される手当）÷　労働日数</td>
        </tr>
      </table>

      <table class="report_list" width="100%">
        <tr>
          <th rowspan="2" width="6%">月/日</th>
          <td colspan="2">新築工事現場の</td>
          <td colspan="3">①10分単位<br />②移動時間は後現場へ</td>
          <td colspan="3">手当等を支給した場合のみ記入</td>
          <th rowspan="2" width="5%">他の<br />仕事</th>
          <th rowspan="2" width="12%">備考</th>
        </tr>
        <tr>
          <th width="9%">契約書番号</th>
          <th width="20%">物件名（フルネーム）</th>
          <th width="8%">入場時刻</th>
          <th width="8%">出場時刻</th>
          <th width="8%">作業時間</th>
          <th width="8%">早出時間</th>
          <th width="8%">残業時間</th>
          <th width="7%">手当等</th>
        </tr>

        <?php
          $pos = 1;
          foreach ($reports as $report):
            if($pos >=31): ?>
        <tr>
          <td width="6%"><?php if($report->work_date){echo $report->work_date->format('n/d');} ?></td>
          <td width="9%"><?= $report->pr['num'] ?></td>
          <td width="20%">
            <?php echo $this->Text->truncate($report->pr['project_name'],
              20, [
                'ending' => '...',
                'exact' => false,
                'html' => false
              ]);
           ?>
          <td width="8%"><?php if($report->start_time){echo $report->start_time->format('G:i');} ?></td>
          <td width="8%"><?php if($report->end_time){echo $report->end_time->format('G:i');} ?></td>
          <td width="8%"><?= $report->diffTime ?></td>
          <td width="8%"><?= $report->shiftTime ?></td>
          <td width="8%"><?= $report->overTime ?></td>
          <td width="7%"><?= $report->allowance ?></td>
          <td width="5%"><?php if( $report->other_work == 1){echo '有り';} ?></td>
          <td width="12%">
            <p class="ellipsis"><?php if($report->holiday_work){echo '休日出勤';} ?><?php if($report->salaried){echo '有給休暇';} ?><?= $report->note ?></p></td>
        </tr>

      <?php
         endif;
        $pos++;
      endforeach;

    if($pos < 62):
      for ($i=$pos; $i <= 62; $i++): ?>
        <tr>
          <td width="6%">　</td>
          <td width="9%">　</td>
          <td width="20%">　</td>
          <td width="8%">　</td>
          <td width="8%">　</td>
          <td width="8%">　</td>
          <td width="8%">　</td>
          <td width="8%">　</td>
          <td width="7%">　</td>
          <td width="5%">　</td>
          <td width="12%">　</td>
        </tr>
    <?php
      endfor;
    endif; ?>

      </table>
      </section>
      <!--▲A4 1ページ分-->

    </div>
  </div>

</section>
<!--大枠-->


<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu'); ?>
<?= $this->element('slidemenu_false'); ?>
<!--▼ユーザーメニュー-->
