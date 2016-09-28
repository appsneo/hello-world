<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Random'), ['action' => 'edit', $random->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Random'), ['action' => 'delete', $random->id], ['confirm' => __('Are you sure you want to delete # {0}?', $random->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Randoms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Random'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="randoms view large-9 medium-8 columns content">
    <h3><?= h($random->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $random->has('user') ? $this->Html->link($random->user->user_id, ['controller' => 'Users', 'action' => 'view', $random->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Random') ?></th>
            <td><?= h($random->random) ?></td>
        </tr>
        <tr>
            <th><?= __('Expiring Date') ?></th>
            <td><?= h($random->expiring_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Created User') ?></th>
            <td><?= h($random->created_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified User') ?></th>
            <td><?= h($random->modified_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($random->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($random->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($random->modified) ?></td>
        </tr>
    </table>
</div>
