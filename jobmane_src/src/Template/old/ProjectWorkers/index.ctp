<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Project Worker'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="projectWorkers index large-9 medium-8 columns content">
    <h3><?= __('Project Workers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('project_id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('created_user') ?></th>
                <th><?= $this->Paginator->sort('modified_user') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projectWorkers as $projectWorker): ?>
            <tr>
                <td><?= $this->Number->format($projectWorker->id) ?></td>
                <td><?= $projectWorker->has('project') ? $this->Html->link($projectWorker->project->id, ['controller' => 'Projects', 'action' => 'view', $projectWorker->project->id]) : '' ?></td>
                <td><?= $projectWorker->has('user') ? $this->Html->link($projectWorker->user->id, ['controller' => 'Users', 'action' => 'view', $projectWorker->user->id]) : '' ?></td>
                <td><?= h($projectWorker->created_user) ?></td>
                <td><?= h($projectWorker->modified_user) ?></td>
                <td><?= h($projectWorker->created) ?></td>
                <td><?= h($projectWorker->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $projectWorker->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectWorker->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectWorker->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectWorker->id)]) ?>
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
