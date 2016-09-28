  <div class="slidemenu slidemenu-right user_menu">

      <div class="slidemenu-header">
        <div class="user_box">
            <dl class="user clfx">

                <dt class="avatar">
                    <img id="preview-photo" class="main_img" altx="preview" src="/users/contents/<?= $auth['id'] ?>" alt="" width="50" />
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
      </div>
    </div>

  </div>
