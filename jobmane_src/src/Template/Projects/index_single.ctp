
<?php $this->assign('title', '単発案件日報一覧 | 業務管理システム'); ?>

<?php $this->start('meta') ?>
<meta name="description" content="単発案件日報一覧 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/daily_report_list.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/coco_pagenation.css" media="all" />
<?php $this->end() ?>

<!--contentns-->
<!--大枠-->
  <section id="body">

    <div class="daily_report_list2">
      <div class="inbox">
        <h1>日報一覧</h1>

        <?= $this->Flash->render() ?>

        <h2 class="project_title">プロジェクト名</h2>

        <div class="search_box">

          <h2>日報絞り込み</h2>

          <ul class="pulldown">
            <li>
              <select id="year" class="time" name="year_yy">
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016" selected="selected">2016</option>
              </select>
              年
            </li>
            <li>
            <select id="month" class="time" name="month_mm">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7" selected="selected">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            月
            </li>
            <li>
            <select id="day" class="time" name="day_dd">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16" selected="selected">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
              <option value="31">31</option>
            </select>
            日
            </li>
          </ul>

          <div class="edit_btn">
            <a href="/reports/index-single/">-新規作成</a>
          </div>

        </div>

        <ul class="user_list">
          <li class="clfx">
              <div class="avatar">
                <img src="../img/common/default_avatar.png" alt="" width="50" />
              </div>
              <div class="info">
                <span class="name">○○さんの日報</span>
                <ul class="btn">
                  <li class="edit">
                    <a href="/reports/edit-single/">編集</a>
                  </li>
                  <li class="browse">
                    <a href="reports/view-single/">閲覧</a>
                  </li>
                </ul>
              </div>
          </li>
          <li class="clfx">
              <div class="avatar">
                <img src="../img/common/default_avatar.png" alt="" width="50" />
              </div>
              <div class="info">
                <span class="name">○○さんの日報</span>
                <ul class="btn">
                  <li class="edit">
                    <a href="daily_report_edit_single-work.html">編集</a>
                  </li>
                  <li class="browse">
                    <a href="daily_report_print.html">閲覧</a>
                  </li>
                </ul>
              </div>
          </li>
          <li class="clfx">
              <div class="avatar">
                <img src="../img/common/default_avatar.png" alt="" width="50" />
              </div>
              <div class="info">
                <span class="name">○○さんの日報</span>
                <ul class="btn">
                  <li class="edit">
                    <a href="daily_report_edit_single-work.html">編集</a>
                  </li>
                  <li class="browse">
                    <a href="daily_report_print.html">閲覧</a>
                  </li>
                </ul>
              </div>
          </li>
        </ul>

        <!--▼Pagenation-->
        <?= $this->element('pagenation') ?>
        <!--▲Pagenation-->

      </div>
    </div>

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu'); ?>
<?= $this->element('slidemenu_false'); ?>
<!--▼ユーザーメニュー-->
