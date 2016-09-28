<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Random'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="randoms index large-9 medium-8 columns content">
    <h3><?= __('Randoms') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('random') ?></th>
                <th><?= $this->Paginator->sort('expiring_date') ?></th>
                <th><?= $this->Paginator->sort('created_user') ?></th>
                <th><?= $this->Paginator->sort('modified_user') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($randoms as $random): ?>
            <tr>
                <td><?= $this->Number->format($random->id) ?></td>
                <td><?= $random->has('user') ? $this->Html->link($random->user->user_id, ['controller' => 'Users', 'action' => 'view', $random->user->id]) : '' ?></td>
                <td><?= h($random->random) ?></td>
                <td><?= h($random->expiring_date) ?></td>
                <td><?= h($random->created_user) ?></td>
                <td><?= h($random->modified_user) ?></td>
                <td><?= h($random->created) ?></td>
                <td><?= h($random->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $random->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $random->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $random->id], ['confirm' => __('Are you sure you want to delete # {0}?', $random->id)]) ?>
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
