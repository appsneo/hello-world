
<?php $this->start('meta'); ?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<meta name="description" content="ユーザー管理 一覧 | 業務管理システム" />
<meta name="keywords" content="業務管理システム," />
<meta name="author" content="業務管理システム" />
<?php $this->end(); ?>

<?php $this->start('css'); ?>
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/manager_user_list.css" media="all" />
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="../js/jquery1.9.1.js" type="text/javascript"></script>
<script src="../js/jquery-migrate-1.2.1.js" type="text/javascript"></script>
<script src="../js/jquery.exflexfixed-0.3.0.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="../js/html5.js" type="text/javascript"></script>
<script src="../js/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->

<script type="text/javascript">
<!--

function disp(){

	window.alert('最低１人にチェックしてください');

}

// -->
</script>

<script type="text/javascript">
<!--

function disp2(){

	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if(window.confirm('○○さんのユーザー情報を削除してもよろしいでしょうか？\n※この操作は取り消せません※')){

		window.alert('OKが選択されました');

	}
	// 「OK」時の処理終了

	// 「キャンセル」時の処理開始
	else{

		window.alert('キャンセルされました');

	}
	// 「キャンセル」時の処理終了

}

// -->
</script>
<?php $this->end(); ?>


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

    <div class="manager_user_list">
      <div class="inbox">
        <h1>ユーザー管理 一覧</h1>

          <div class="edit_btn">
            <a href="/users/add_pr/">+新規作成</a>
          </div>

          <div id="mail_btn" class="mail_btn">
             <ul>
              <li class="title">メール：</li>
              <li class="all_btn">
                <a href="mailto:aaa@aaa.com;bbb@bbb.com;ccc@ccc.com;ddd@ddd.com;eee@eee.com;fff@fff.com">全員に<img src="/img/manager_uer/all_pict.png" alt="" width="31" /></a>
              </li>
              <li class="check_btn">
                <span>チェックした人に<img src="/img/manager_uer/check_pict.png" alt="" width="31" /></span>
              </li>
            </ul>
          </div>

          <div id="show" class="hidden"><p></p></div>

        <ul class="user_list">

					<?php foreach ($users as $user): ?>
          <li class="clfx">
              <div class="avatar">
								<?php if( $user->avatar == NULL) { ?>
									<img src="/img/common/default_avatar.png" alt="" width="50" />
								<?php } else { ?>
								<img src="/users/contents/<?= $user->id ?>" alt="" width="50" />
								<?php } ?>
              </div>
              <div class="info">
                <span class="name"><?= $user->id . " : " . $user->name ?></span>
                <ul class="btn">
                  <li class="edit">
                    <a href="/users/edit/<?= $user->id ?>">編集</a>
                  </li>
                  <li class="browse">
                    <a href="/company/edit/<?= $user->id ?>">会社</a>
                  </li>
                  <li class="browse">
                    <a href="/users/delete/<?= $user->id ?>">削除</a>
                  </li>
                </ul>

                <span class="check">
                  <input id="user01" type="checkbox" name="user01" value="user01" />
                  <label for="user01" class="hidden">aaa@aaa.com</label>
                </span>
              </div>
          </li>
				<?php endforeach; ?>

          <li class="clfx">
              <div class="avatar">
                <img src="/img/common/default_avatar.png" alt="" width="50" />
              </div>
              <div class="info">
                <span class="name">○○さん</span>
                <ul class="btn">
                  <li class="edit">
                    <a href="/users/edit/1">編集</a>
                  </li>
                  <li class="browse">
                    <a href="manager_charge_list.html">会社</a>
                  </li>
                  <li class="delete">
                    <span onClick="disp2()">削除</span>
                  </li>
                </ul>

                <span class="check">
                  <input id="user06" type="checkbox" name="user06" value="user06" />
                  <label for="user06" class="hidden">eee@eee.com</label>
                </span>
              </div>
          </li>
          <li class="clfx">
              <div class="avatar">
                <img src="/img/common/default_avatar.png" alt="" width="50" />
              </div>
              <div class="info">
                <span class="name">○○さん</span>
                <ul class="btn">
                  <li class="edit">
                    <a href="users/edit/1">編集</a>
                  </li>
                  <li class="browse">
                    <a href="manager_charge_list.html">会社</a>
                  </li>
                  <li class="delete">
                    <span onClick="disp2()">削除</span>
                  </li>
                </ul>

                <span class="check">
                  <input id="user07" type="checkbox" name="user07" value="user07" />
                  <label for="user07" class="hidden">fff@fff.com</label>
                </span>
              </div>
          </li>
        </ul>

      </div>
    </div>

  </section>
<!--大枠-->

  <!--▼ユーザーメニュー-->
	<?= $this->element('slidemenu') ?>
	<?= $this->element('slidemenu_true'); ?>
  <!--▲ユーザーメニュー-->

<script type="text/javascript">
var $c = $('div.manager_user_list input[type="checkbox"]');

$c.bind('change', function(){
var add = '';
$c.each(function(index, value) {
if (this.checked){
//チェックと同時にlabelのfor属性の値をテキストとして表示する
add += ($('label[for="' + this.name + '"]').html() + '; ');
}
});

//id="show p"内に挿入
$('#show p').html(add);
});

$('li.check_btn span').click(function() {
  if($('#show p').text() != '') {
    location.href = 'mailto:'+ $('#show p').text();
  } else {
    disp();
  }
});
</script>


<script type="text/javascript">
jQuery(function($){
	$('div#mail_btn').exFlexFixed({
		container : 'body',
		fixedHeader : '#header'

	});
});
</script>
