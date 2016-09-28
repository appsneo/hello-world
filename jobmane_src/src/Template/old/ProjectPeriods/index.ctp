<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Project Period'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="projectPeriods index large-9 medium-8 columns content">
    <h3><?= __('Project Periods') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('company_id') ?></th>
                <th><?= $this->Paginator->sort('project_id') ?></th>
                <th><?= $this->Paginator->sort('start') ?></th>
                <th><?= $this->Paginator->sort('end') ?></th>
                <th><?= $this->Paginator->sort('created_user') ?></th>
                <th><?= $this->Paginator->sort('modified_user') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projectPeriods as $projectPeriod): ?>
            <tr>
                <td><?= $this->Number->format($projectPeriod->id) ?></td>
                <td><?= $projectPeriod->has('company') ? $this->Html->link($projectPeriod->company->name, ['controller' => 'Companies', 'action' => 'view', $projectPeriod->company->id]) : '' ?></td>
                <td><?= $projectPeriod->has('project') ? $this->Html->link($projectPeriod->project->id, ['controller' => 'Projects', 'action' => 'view', $projectPeriod->project->id]) : '' ?></td>
                <td><?= h($projectPeriod->start) ?></td>
                <td><?= h($projectPeriod->end) ?></td>
                <td><?= h($projectPeriod->created_user) ?></td>
                <td><?= h($projectPeriod->modified_user) ?></td>
                <td><?= h($projectPeriod->created) ?></td>
                <td><?= h($projectPeriod->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $projectPeriod->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectPeriod->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectPeriod->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectPeriod->id)]) ?>
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
