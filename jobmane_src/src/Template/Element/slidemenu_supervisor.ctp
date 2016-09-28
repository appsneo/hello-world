
  <div class="slidemenu slidemenu-right user_menu">

      <div class="slidemenu-header">
        <div class="user_box">
            <dl class="user clfx">
              <dt class="avatar"><img src="/img/common/default_avatar.png" alt="" width="62" /></dt>
              <dd class="name">
                  <span class="name"><?= $auth['name'] ?></span>
                  <span class="name">
                    <?php if($auth['role']=="operator"){echo "作業員";}
                    elseif($auth['role']=="president"){echo "管理者";}
                    elseif($auth['role']=="supervisor"){echo "スーパーバイザー";} ?>
                <span class="logout"><a href="/users/logout/" id="as_logout">[ログアウト]</a></span>
              </dd>
            </dl>
        </div>
      </div>

    <div class="slidemenu-body">
      <div class="slidemenu-content">
        <p class="subtitle">スーパーバイザー・メニュー</p>
        <ul class="menu">
          <li>
            <a href="/menu/" id="as_worker">メニュー画面</a>
          </li>
        </ul>
        <ul class="menu">
          <li>
            <a href="/users/index-president/<?= $auth['id'] ?>" id="as_presidents">管理者・会社情報</a>
          </li>
        </ul>
      </div>
    </div>

  </div>
