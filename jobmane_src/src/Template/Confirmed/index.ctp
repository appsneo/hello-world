<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Confirmed'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="confirmed index large-9 medium-8 columns content">
    <h3><?= __('Confirmed') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('confirmed_id') ?></th>
                <th><?= $this->Paginator->sort('expired_date') ?></th>
                <th><?= $this->Paginator->sort('created_user') ?></th>
                <th><?= $this->Paginator->sort('modified_user') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($confirmed as $confirmed): ?>
            <tr>
                <td><?= $this->Number->format($confirmed->id) ?></td>
                <td><?= $confirmed->has('user') ? $this->Html->link($confirmed->user->user_id, ['controller' => 'Users', 'action' => 'view', $confirmed->user->id]) : '' ?></td>
                <td><?= h($confirmed->confirmed_id) ?></td>
                <td><?= h($confirmed->expired_date) ?></td>
                <td><?= h($confirmed->created_user) ?></td>
                <td><?= h($confirmed->modified_user) ?></td>
                <td><?= h($confirmed->created) ?></td>
                <td><?= h($confirmed->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $confirmed->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $confirmed->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $confirmed->id], ['confirm' => __('Are you sure you want to delete # {0}?', $confirmed->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
