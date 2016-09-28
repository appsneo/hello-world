<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Avatar'), ['action' => 'edit', $avatar->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Avatar'), ['action' => 'delete', $avatar->id], ['confirm' => __('Are you sure you want to delete # {0}?', $avatar->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Avatars'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Avatar'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="avatars view large-9 medium-8 columns content">
    <h3><?= h($avatar->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $avatar->has('user') ? $this->Html->link($avatar->user->user_id, ['controller' => 'Users', 'action' => 'view', $avatar->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Created User') ?></th>
            <td><?= h($avatar->created_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified User') ?></th>
            <td><?= h($avatar->modified_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($avatar->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($avatar->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($avatar->modified) ?></td>
        </tr>
    </table>
</div>
