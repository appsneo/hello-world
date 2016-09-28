<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Users001'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users001 index large-9 medium-8 columns content">
    <h3><?= __('Users001') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('password') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('blood_type') ?></th>
                <th><?= $this->Paginator->sort('medical_checked_date') ?></th>
                <th><?= $this->Paginator->sort('joined_date') ?></th>
                <th><?= $this->Paginator->sort('leaving_date') ?></th>
                <th><?= $this->Paginator->sort('birth_date') ?></th>
                <th><?= $this->Paginator->sort('emergency') ?></th>
                <th><?= $this->Paginator->sort('capbilities') ?></th>
                <th><?= $this->Paginator->sort('safety') ?></th>
                <th><?= $this->Paginator->sort('created_user') ?></th>
                <th><?= $this->Paginator->sort('modified_user') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users001 as $users001): ?>
            <tr>
                <td><?= $this->Number->format($users001->id) ?></td>
                <td><?= h($users001->name) ?></td>
                <td><?= h($users001->password) ?></td>
                <td><?= h($users001->email) ?></td>
                <td><?= h($users001->status) ?></td>
                <td><?= h($users001->blood_type) ?></td>
                <td><?= h($users001->medical_checked_date) ?></td>
                <td><?= h($users001->joined_date) ?></td>
                <td><?= h($users001->leaving_date) ?></td>
                <td><?= h($users001->birth_date) ?></td>
                <td><?= h($users001->emergency) ?></td>
                <td><?= h($users001->capbilities) ?></td>
                <td><?= h($users001->safety) ?></td>
                <td><?= h($users001->created_user) ?></td>
                <td><?= h($users001->modified_user) ?></td>
                <td><?= h($users001->created) ?></td>
                <td><?= h($users001->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $users001->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $users001->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $users001->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users001->id)]) ?>
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
