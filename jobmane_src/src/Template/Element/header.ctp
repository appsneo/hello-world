  <!-- header -->
  <header id="header">
    <div class="inbox">
      <ul>
      <?php if(!isset($header) || $header !== "no") : ?>
        <li class="back_btn">
          <span onClick="history.back(); return false;">&nbsp;</span>
        </li>
        <li class="menu">
          <span class="menu-button-right">&nbsp;</span>
        </li>
      <?php endif; ?>
        <li class="logo">
        業務管理システム
        </li>
      </ul>

    </div>
  </header>
  <!-- header -->
