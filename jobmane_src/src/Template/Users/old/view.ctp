<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <table class="vertical-table">
        <tr>
            <th><?= __('Password') ?></th>
            <td></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td></td>
        </tr>
    </table>
</div>
