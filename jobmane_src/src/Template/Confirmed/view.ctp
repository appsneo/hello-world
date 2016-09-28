<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Confirmed'), ['action' => 'edit', $confirmed->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Confirmed'), ['action' => 'delete', $confirmed->id], ['confirm' => __('Are you sure you want to delete # {0}?', $confirmed->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Confirmed'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Confirmed'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Confirmed'), ['controller' => 'Confirmed', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Confirmed'), ['controller' => 'Confirmed', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="confirmed view large-9 medium-8 columns content">
    <h3><?= h($confirmed->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $confirmed->has('user') ? $this->Html->link($confirmed->user->user_id, ['controller' => 'Users', 'action' => 'view', $confirmed->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Confirmed Id') ?></th>
            <td><?= h($confirmed->confirmed_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Expired Date') ?></th>
            <td><?= h($confirmed->expired_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Created User') ?></th>
            <td><?= h($confirmed->created_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified User') ?></th>
            <td><?= h($confirmed->modified_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($confirmed->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($confirmed->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($confirmed->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Confirmed') ?></h4>
        <?php if (!empty($confirmed->confirmed)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Confirmed Id') ?></th>
                <th><?= __('Expired Date') ?></th>
                <th><?= __('Created User') ?></th>
                <th><?= __('Modified User') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($confirmed->confirmed as $confirmed): ?>
            <tr>
                <td><?= h($confirmed->id) ?></td>
                <td><?= h($confirmed->user_id) ?></td>
                <td><?= h($confirmed->confirmed_id) ?></td>
                <td><?= h($confirmed->expired_date) ?></td>
                <td><?= h($confirmed->created_user) ?></td>
                <td><?= h($confirmed->modified_user) ?></td>
                <td><?= h($confirmed->created) ?></td>
                <td><?= h($confirmed->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Confirmed', 'action' => 'view', $confirmed->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Confirmed', 'action' => 'edit', $confirmed->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Confirmed', 'action' => 'delete', $confirmed->id], ['confirm' => __('Are you sure you want to delete # {0}?', $confirmed->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
