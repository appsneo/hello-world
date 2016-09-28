<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

<title>プロジェクト管理 単発プロジェクト | 業務管理システム</title>
<meta name="description" content="プロジェクト管理 単発プロジェクト | 業務管理システム" />
<meta name="keywords" content="業務管理システム," />
<meta name="author" content="業務管理システム" />

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_project_detail.css" media="all" />
<?php $this->end() ?>

<?php $this->start('script') ?>
<script src="/js/jquery.ui.datepicker-ja.js"></script>
<!--[if lt IE 9]>
<script src="../js/html5.js" type="text/javascript"></script>
<script src="../js/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->
<script>
$(document).ready(function() {
   $('#a-submit').click(function(){
    $(".form-post").submit();
//    alert('Sign new href executed.');
    return false;
   });
});
</script>
<?php $this->end() ?>

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
      <?php if($mode == "add") { ?>
          <form id="form-post" class="form-post" name="form-post" action='/projects/add-single/' method='post'>
      <?php } else { ?>
          <form id="form-post" class="form-post" name="form-post" action='/projects/edit-single/<?= $project->id ?>' method='post'>
      <?php } ?>

    <div class="manager_project_detail_single">
      <div class="inbox">
        <h1>プロジェクト管理 単発プロジェクト</h1>

            <ul class="error">
              <li>現場名は入力必須です</li>
              <li>注文番号は入力必須です</li>
            </ul>

    <?php
      if(isset($errors)):
          $fields = 'num,project_name,client,category,money,start,end,address,charge,operators,select_file';
          echo $this->Consumer->getErrorHtml($errors, $fields, true);
      endif;
    ?>


          <h2 class="sub_title">現場名<span class="required">必須</span></h2>
          <input class="text" type="text" name="project_name" size="24" value="<?= $project->project_name ?>"/>

          <h2 class="sub_title">注文番号<span class="required">必須</span></h2>
          <input class="text" type="text" name="num" size="24" value="<?= $project->num ?>"/>


                            <h2 class="sub_title">
                              作業員指定
                              <span class="required">必須</span>
                            </h2>

                            <ul class="operator_list clfx">

                                <?php
                                    $pos = 0;
                                    foreach ($project->users as $user):
                                      $hit = false;
                                      echo '$user->id : ' . $user->id . '<br>';
                              //        if($mode == 'edit') {
                                        foreach ($project->project_users as $worker):
                                          echo 'projectsUsers->user_id : ' . $worker->user_id . '<br>';
                                          if( $worker->user_id == $user->id ):
                                            $hit = true;
                                            echo 'hit<br>';
                                          endif;
                                        endforeach;
                              //        }
                                ?>
                                      <li>
                                        <label class="clfx">
                                          <dl>
                                            <dt><input type="checkbox" name="operators[<?= $pos++ ?>]" value="<?= $user->id ?>"  <?php if($hit) {echo 'checked="checked"'; } ?> /></dt>
                                            <dd><?= $user->id ?> : <?= $user->name ?> さん</dd>
                                          </dl>
                                        </label>
                                      </li>
            <?php endforeach; ?>


                              <li>
                                <label class="clfx">
                                  <dl>
                                    <dt><input type="checkbox" name="○○" value="checkboxValue" /></dt>
                                    <dd>○○さん</dd>
                                  </dl>
                                </label>
                              </li>

                              <li>
                                <label class="clfx">
                                  <dl>
                                    <dt><input type="checkbox" name="◇◇" value="checkboxValue" /></dt>
                                    <dd>◇◇さん</dd>
                                  </dl>
                                </label>
                              </li>

                              <li>
                                <label class="clfx">
                                  <dl>
                                    <dt><input type="checkbox" name="△△" value="checkboxValue" /></dt>
                                    <dd>△△さん</dd>
                                  </dl>
                                </label>
                              </li>

                              <li>
                                <label class="clfx">
                                  <dl>
                                    <dt><input type="checkbox" name="☆☆" value="checkboxValue" /></dt>
                                    <dd>☆☆さん</dd>
                                  </dl>
                                </label>
                              </li>

                            </ul>

            <h2 class="sub_title">
              期間指定
          <span class="required">必須</span>
            </h2>

           <div class="row">
                <div class="period clfx">
                <div class="start">
                  <h3 class="sub_title"><img src="/img/common/calendar_pict.png" alt="" width="20" />工事着手日</h3>
                  <input class="day datepicker date_start" type="text" readonly="readonly" name="start" size="24" value="<?= $project->start ?>" />
                </div>
                <div class="end">
                  <h3 class="sub_title"><img src="/img/common/calendar_pict.png" alt="" width="20" />工事完了日</h3>
                  <input class="day datepicker date_end" type="text" readonly="readonly" name="end" size="24" value="<?= $project->end ?>" />
                </div>
              </div>
            </div>

          <h2 class="sub_title">現場住所</h2>
          <textarea class="text" name="address" rows="2" cols="40"><?= $project->address ?></textarea>

          <h2 class="sub_title">取引会社名</h2>
          <input class="text" type="text" name="client" size="24" value="<?= $project->client ?>"/>

          <h2 class="sub_title">協力会社名(2次業者名)</h2>
          <input class="text" type="text" name="secondary" size="24" value="<?= $project->secondary ?>"/>

          <h2 class="sub_title">注文内容</h2>
          <textarea class="text" name="summary" rows="2" cols="40"><?= $project->summary ?></textarea>


          <div class="save_btn">
            <a href="#" id="a-submit">プロジェクト保存</a>
          </div>

      </div>
    </div>

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?php echo $this->element('slidemenu'); ?>
<!--▼ユーザーメニュー-->

<script>
$(function(){
    $('.datepicker').datepicker('setDate', 'today');
});
</script>
    <script type="text/javascript">
    (function($){

        $.fn.eventeditor=function(config){

            return this.each(function(i){

                $(this).find('input.datepicker').datepicker({'showButtonPanel': true}).datepicker({ defaultDate: 'today', dateFormat: "yy/mm/d",});


            });
        };

        // execute
        $('div.period').eventeditor();

    })(jQuery);


   </script>
