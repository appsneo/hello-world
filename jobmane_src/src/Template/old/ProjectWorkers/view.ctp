<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Project Worker'), ['action' => 'edit', $projectWorker->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Project Worker'), ['action' => 'delete', $projectWorker->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectWorker->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Project Workers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project Worker'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="projectWorkers view large-9 medium-8 columns content">
    <h3><?= h($projectWorker->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Project') ?></th>
            <td><?= $projectWorker->has('project') ? $this->Html->link($projectWorker->project->id, ['controller' => 'Projects', 'action' => 'view', $projectWorker->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $projectWorker->has('user') ? $this->Html->link($projectWorker->user->id, ['controller' => 'Users', 'action' => 'view', $projectWorker->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Created User') ?></th>
            <td><?= h($projectWorker->created_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified User') ?></th>
            <td><?= h($projectWorker->modified_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($projectWorker->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($projectWorker->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($projectWorker->modified) ?></td>
        </tr>
    </table>
</div>
