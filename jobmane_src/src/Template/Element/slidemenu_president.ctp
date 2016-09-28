  <div class="slidemenu slidemenu-right user_menu">

      <div class="slidemenu-header">
        <div class="user_box">
            <dl class="user clfx">

                <dt class="avatar">
                    <img id="preview-photo" class="main_img" src="/users/contents/<?= $auth['id'] ?>" alt="" width="50" />
                </dt>

              <dd class="name">
                  <span class="name"><?= $auth['name'] ?></span>
                  <span class="name">
                    <?php if($auth['role']=="operator"){echo "作業員";}
                    elseif($auth['role']=="president"){echo "管理者";}
                    elseif($auth['role']=="supervisor"){echo "スーパーバイザー";} ?>
                  </span>
                <span class="logout"><a href="/users/logout/" id="as_logout">[ログアウト]</a></span>
              </dd>
            </dl>
        </div>
      </div>

    <div class="slidemenu-body">
      <div class="slidemenu-content">
        <p class="subtitle">目次</p>
        <ul class="menu">
          <ul class="main_menu">
            <li>
              <a href="/menu/" id="as_menu">メニュー画面</a>
            </li>
            <li>
              <a href="/projects/index-worker/" id="as_worker">プロジェクト一覧</a>
            </li>
            <li>
              <a href="/projects/index-report" id="as_report">日報</a>
            </li>
            <li>
              <a href="/reports/index-monthly" id="as_monthly">月報</a>
            </li>
          </ul>
          <p class="subtitle">管理者メニュー</p>
          <ul class="menu">
            <li>
              <a href="/users/index" id="as_users">ユーザー管理</a>
            </li>
            <li>
              <a href="/projects/index/" id="as_projects">プロジェクト管理</a>
            </li>
            <li>
              <a href="/users/edit-president/<?= $auth['id'] ?>" id="as_president">管理者・会社情報</a>
            </li>
            <li>
              <a href="/materials/index/<?= $auth['company_id'] ?>" id="as_materials">使用部材</a>
            </li>
            <li>
              <a href="/clients/index/<?= $auth['company_id'] ?>" id="as_clients">取引先</a>
            </li>
            <li>
              <a href="/categories/index/<?= $auth['company_id'] ?>" id="as_categories">作業種別 </a>
            </li>
          </ul>

        </ul>
      </div>
    </div>

  </div>
