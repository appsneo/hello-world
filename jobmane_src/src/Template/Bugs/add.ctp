
<?php $this->assign('title', 'バグ報告 | 業務管理システム'); ?>

<?php $this->start('meta') ?>
<meta name="description" content="バグ報告 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<?php $this->end() ?>


<script>
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

  $("#a_new").click(function(){
    $(".form-post").action("/bugs/new");
    alert("a_new");
    $(".form-post").submit();
    return false;
  });

  $("#a_wr").click(function(){
    $("#wr_user_name").val($("#user_name").val());
    alert("a_wr");
    return false;
  });

  $("#a_up").click(function(){
      $("#up_user_name").val($("#user_name").val());
      alert("a_up");
      return false;
  });

  $("#a_save").click(function(){
    $(".form-post").action("/bugs/add");
    alert("a_save");
    $("#form-post").submit();
    return false;
  });

    $("#a_sveategories").click(function(){
        $("#next").val("categories");
        $("#form-post").submit();
        return false;
    });

});

</script>

<style>
div span.label_s {
  margin-left: 8px;
  margin-right: 6px;
  width: 70px;
}
.text_s {
  width: 80px;
}

.area {
  width: 600px;
  height: 100px;
  margin-left: 8px;
  margin-top: 5px;
}

fieldset {
  margin-left: 10px;
  margin-top: 8px;
  margin-right: 10px;
  padding-top: 3px;
  padding-bottom: 5px;
  width: 620px;
}

.paginator, fieldset {
  margin-right: auto;
  margin-left: auto;
  width: 620px;
}

.btn {
  font-size: 18px;
  margin: 20px 10px 2px 3px;
  padding: 18px 5px 2px 5px;
  height: 28px;
  width: 82px;
}

</style>

<br>
<br>
<br>
<br>

<!--contentns-->
<!--大枠-->
  <section id="body">

<form id="form-post" enctype="multipart/form-data" accept-charset="utf-8"  class="form-post" name="form-post" action='' method='post'>


<div class="bugs form large-9 medium-8 columns content">
    <?= $this->Form->create($bug) ?>
    <fieldset>
        <legend>不具合・要望等&nbsp;</legend>

        <div><span class="label_s">報告者</span>
        <input type="text" name="wr_user_id" id="wr_user_name" class="text_s" />
        <span class="label_s">記入日</span>
        <input type="text" name="wr_date" id="wr_date" class="text_s" value="<?= $bug->wr_date ?>"/>

        <?php
            $places = ['none' => '-','user' => 'ユーザー', 'project' => 'プロジェクト', 'report' =>  '日報', 'monthly' =>  '月報', 'calendar' =>  'カレンダー', 'others' =>  'その他'];
            echo '<span class="label_s">モジュール</span>';
            echo $this->Form->select('type', $places, ['default' => 'user']);
            $types = ['none' => '-','bug' => '不具合', 'spec' => '仕様確認', 'ask' =>  '質問等', 'request' =>  '要望', 'others' =>  'その他'];
            echo '<span class="label_s">問合せ</span>';
            echo $this->Form->select('type', $types, ['default' => 'user']);
        ?>
        </div>
        <div></div>
        <div><textarea  name="wr_note" class="area"><?= $bug->wr_note ?></textarea></div>
</fieldset>
        <fieldset>
            <legend>回答&nbsp;</legend>

      <div><span class="label_s">回答者</span>
        <input type="text" name="up_user_id" class="text_s" value="<?= $bug->up_user_id ?>"/>
      <span class="label_s">回答日</span>
        <input type="text" name="up_date" id="up_date" class="text_s" value="<?= $bug->up_date ?>"/>

        <?php
                    $results = ['none' => '-','ready' => '未着手', 'going' => '処理中 ..', 'end' =>  '終了', 'pendding' =>  '保留 ..', 'others' =>  'その他'];
                    echo '<span class="label_s">処理状態</span>';
                    echo $this->Form->select('type', $results, ['default' => 'user']);
                    echo '</div>';
                ?>

      <div></div>
      <textarea  name="up_note" class="area"><?= $bug->up_note ?></textarea>

    </fieldset>

    <fieldset style ="height:210px;">
        <legend>画像表示等</legend>

        <div style="float: right; ">
          <input type="button" value="新規表示" id="a_new" class="btn" />
          <input type="button" value="報告する" id="a_wr" class="btn" />
          <input type="button" value="回答する" id="a_up" class="btn"  />
          <input type="button" value="保存する" id="a_save" class="btn" style="margin-right:24px;" />
          <input type="text" value="<?= $bug->user->name ?>" id="user_name" />
        </div>
        <div id="avatar" style="margin-left:15px;margin-top:5px;margin-bottom:5px;">
          <?php if( $bug->image == null) { ?>
            <img id="preview-photo" class="main_img" width="160" height="160" altx="preview"  src="/img/common/default_avatar.png" alt="" width="50" />
          <?php } else { ?>
            <img id="preview-photo" class="main_img" width="160" height="160" altx="preview" src="/users/contents/<?= $user->id ?>" alt="" width="50" />
          <?php } ?>
        </div>
        <div style="float: right; ">
          <input type="button" value="一覧表示" class="btn" style="margin-top:-60px; margin-right:180px;" />
        </div>
        <div id="select-file" style="margin-left:10px;">
          <input type="file" id="select-photo" class="file" name="photo" id="photo" onchangexxx="imgUpload(this)" />
        </div>
    </fieldset>
    <?= $this->Form->end() ?>

<div class="paginator" >
  <ul class="pagination pagenation">
    <?= $this->Paginator->prev($title='＜　前へ', $options=['img' => '/img/common/c_back.png']) ?>
    <?= $this->Paginator->numbers([ 'modulus' => 3, 'first' => 1, 'last' => 1 ]) ?>
    <?= $this->Paginator->next('次へ　＞') ?>
  </ul>
</div>

</div>
</form>
</section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?php echo $this->element('slidemenu'); ?>
<!--▼ユーザーメニュー-->
