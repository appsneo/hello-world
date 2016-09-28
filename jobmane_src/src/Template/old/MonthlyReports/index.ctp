<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Monthly Report'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="monthlyReports index large-9 medium-8 columns content">
    <h3><?= __('Monthly Reports') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('company_id') ?></th>
                <th><?= $this->Paginator->sort('project_id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('month') ?></th>
                <th><?= $this->Paginator->sort('created_user') ?></th>
                <th><?= $this->Paginator->sort('modified_user') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($monthlyReports as $monthlyReport): ?>
            <tr>
                <td><?= $this->Number->format($monthlyReport->id) ?></td>
                <td><?= $monthlyReport->has('company') ? $this->Html->link($monthlyReport->company->name, ['controller' => 'Companies', 'action' => 'view', $monthlyReport->company->id]) : '' ?></td>
                <td><?= $monthlyReport->has('project') ? $this->Html->link($monthlyReport->project->id, ['controller' => 'Projects', 'action' => 'view', $monthlyReport->project->id]) : '' ?></td>
                <td><?= $monthlyReport->has('user') ? $this->Html->link($monthlyReport->user->id, ['controller' => 'Users', 'action' => 'view', $monthlyReport->user->id]) : '' ?></td>
                <td><?= h($monthlyReport->month) ?></td>
                <td><?= h($monthlyReport->created_user) ?></td>
                <td><?= h($monthlyReport->modified_user) ?></td>
                <td><?= h($monthlyReport->created) ?></td>
                <td><?= h($monthlyReport->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $monthlyReport->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $monthlyReport->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $monthlyReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $monthlyReport->id)]) ?>
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
