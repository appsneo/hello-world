<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New How'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hows index large-9 medium-8 columns content">
    <h3><?= __('Hows') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hows as $how): ?>
            <tr>
                <td><?= $this->Number->format($how->id) ?></td>
                <td><?= h($how->name) ?></td>
                <td><?= h($how->created) ?></td>
                <td><?= h($how->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $how->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $how->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $how->id], ['confirm' => __('Are you sure you want to delete # {0}?', $how->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers(['first' => 'First', 'last' => 'Last', 'modulus' => 3]) ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
