<br>
<br>
<br>
<br>
<br>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bug'), ['action' => 'add']) ?></li>
    </ul>
</nav>

<div class="bugs index large-9 medium-8 columns content">
    <h3><?= __('Bugs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('wr_user_id') ?></th>
                <th><?= $this->Paginator->sort('up_user_id') ?></th>
                <th><?= $this->Paginator->sort('wr_date') ?></th>
                <th><?= $this->Paginator->sort('up_date') ?></th>
                <th><?= $this->Paginator->sort('wr_note') ?></th>
                <th><?= $this->Paginator->sort('up_note') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bugs as $bug): ?>
            <tr>
                <td><?= $this->Number->format($bug->id) ?></td>
                <td><?= h($bug->wr_user_id) ?></td>
                <td><?= h($bug->up_user_id) ?></td>
                <td><?= h($bug->wr_date) ?></td>
                <td><?= h($bug->up_date) ?></td>
                <td><?= h($bug->wr_note) ?></td>
                <td><?= h($bug->up_note) ?></td>
                <td><?= h($bug->type) ?></td>
                <td><?= h($bug->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bug->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bug->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bug->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bug->id)]) ?>
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
