
  <div class="slidemenu slidemenu-right user_menu">

      <div class="slidemenu-header">
        <div class="user_box">
            <dl class="user clfx">
              <dt class="avatar"><img src="/img/common/default_avatar.png" alt="" width="62" /></dt>
              <dd class="name">
                <span class="name"><?= $user->name ?> : <?= $user->id ?></span>
                <span class="logout"><a href="/users/logout/">[ログアウト]</a></span>
              </dd>
            </dl>
        </div>
      </div>

    <div class="slidemenu-body">
      <div class="slidemenu-content">
        <p class="subtitle">目次</p>
        <ul class="menu">
          <li>
            <a href="/projects">プロジェクト一覧</a>
          </li>
          <li>
            <a href="/reports/index-project">日報</a>
          </li>
          <li>
            <a href="/reports/index-monthly">月報</a>
          </li>
        </ul>
        <p class="subtitle">管理者メニュー</p>
        <ul class="menu">
          <li>
            <a href="/users/index/">ユーザー管理</a>
          </li>
          <li>
            <a href="/projects/index/">プロジェクト管理</a>
          </li>
        </ul>
      </div>
    </div>

  </div>

<script type="text/javascript" src="/js/sp-slidemenu.js"></script>
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
