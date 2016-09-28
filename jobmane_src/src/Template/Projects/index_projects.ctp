
<?php $this->assign('title', 'プロジェクト別一覧 | 業務管理システム'); ?>

<?php $this->start('meta') ?>
<meta name="description" content="プロジェクト別一覧 | 業務管理システム" />
<?php $this->end() ?>

<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/css/sp-slidemenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/project_table.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/coco_pagenation.css" media="all" />

<?php $this->end() ?>

<script src="/js/project/table_fixed.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
   $('.status').change(function(){
     $(".form-post").attr('action', "/projects/index-projects?status=" + $(this).val());
 //     alert ($(".form-post").attr('action'));
 //     $(".form-post").attr('action', "/projects/index-projects?status=" + $('.status').val());
 //   alert ($(".form-post").attr('action'));
     $(".form-post").submit();
    return false;
   });
   $('#sasc').click(function(){
     $(".form-post").attr('action', "/projects/index-projects?status=" + $('.status').val() + "&order=sasc");
//   alert ($(".form-post").attr('action'));
     $(".form-post").submit();
  //  alert('Status change.');
     return false;
   });
   $('#sdesc').click(function(){
     $(".form-post").attr('action', "/projects/index-projects?status=" + $('.status').val() + "&order=sdesc");
     $(".form-post").submit();
     return false;
   });
   $('#easc').click(function(){
     $(".form-post").attr('action', "/projects/index-projects?status=" + $('.status').val() + "&order=easc");
     $(".form-post").submit();
     return false;
   });
   $('#edesc').click(function(){
     $(".form-post").attr('action', "/projects/index-projects?status=" + $('.status').val() + "&order=edesc");
     $(".form-post").submit();
     return false;
   });

   $('.a_proj').click(function(){
     var pos = $(".a_proj").index($(this));
     //alert(pos);
     var action = $(".a_proj").get(pos).href; //.attr('class');
//     alert(action);
     $(".form-post").attr('action', action);
     $(".form-post").submit();
     return false;
   });


});
</script>




<!--contentns-->
<!--大枠-->
  <section id="body">

    <div class="project_table">
      <div class="inbox">
        <h1>プロジェクト別一覧</h1>

    <form id="form-post" class="form-post" name="form-post" action='/projects/index-projects/' method='post'>
		<table class="project_table tablelock" width="100%">
			<thead>
				<tr>
					<th width="28%"></th>
					<th width="26%">
					着工
					  <ul class="sort clfx">
					    <li class="start top" title="新しい順に並び替え">
					      <a href="#new" id="sdesc">▲<span>新しい順</span></a>
					    </li>
					    <li class="start down" title="古い順に並び替え">
					      <a href="#old" id="sasc">▼<span>古い順</span></a>
					    </li>
					  </ul>
					</th>
					<th width="26%">
					  竣工
					  <ul class="sort clfx">
					    <li class="end top" title="新しい順に並び替え">
					      <a href="#new" id="edesc">▲<span>新しい順</span></a>
					    </li>
					    <li class="end down" title="古い順に並び替え">
					      <a href="#old" id="easc">▼<span>古い順</span></a>
					    </li>
					  </ul>
					</th>
					<th width="20%">
					  状態
					  <select class="status" name="selectName" size="1">
					    <option value="all" <?php if($this->request->query('status') == 'all'){echo 'selected="selected"';}?>>すべて</option>
					    <option value="not_started"<?php if($this->request->query('status') == 'not_started'){echo 'selected="selected"';}?>>未着手</option>
					    <option value="progress" <?php if($this->request->query('status') == 'progress'){echo 'selected="selected"';}?>>進行中</option>
					    <option value="end" <?php if($this->request->query('status') == 'end'){echo 'selected="selected"';}?>>終了</option>
					  </select>
					</th>
				</tr>
			</thead>
			<tbody>
    <?php $today = new dateTime('Now'); ?>
	<?php foreach ($projects as $project): ?>
				<tr>
					<td class="name" width="28%"><a href="/projects/reports/<?= $project->id ?>" class="a_proj"><?= $project->project_name ?></a></td>
					<td width="26%"><?= $project->start_str ?></td>
					<td width="26%"><?= $project->end_str ?></td>

            <?php if($project->completion_check): ?>
                    <td width="20%"><span class="end">終了</span></td>
            <?php elseif($project->status == "not_started"): ?>
					<td width="20%"><span class="not_started">未着手</span></td>
            <?php elseif($project->status == "progress"): ?>
                    <td width="20%"><span class="progress">進行中</span></td>
            <?php else: ?>
                    <td width="20%"><span class="progress">進行中</span></td>
      <?php endif; ?>
				</tr>
    <?php endforeach; ?>

			</tbody>
		</table>
  </form>

  <!--▼Pagenation-->
  <?= $this->element('pagenation') ?>
  <!--▲Pagenation-->

      </div>
    </div>

  </section>
<!--大枠-->

<!--▼ユーザーメニュー-->
<?= $this->element('slidemenu') ?>
<?= $this->element('slidemenu_false') ?>
<!--▼ユーザーメニュー-->
