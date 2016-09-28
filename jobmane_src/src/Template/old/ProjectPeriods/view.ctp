<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Project Period'), ['action' => 'edit', $projectPeriod->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Project Period'), ['action' => 'delete', $projectPeriod->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectPeriod->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Project Periods'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project Period'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="projectPeriods view large-9 medium-8 columns content">
    <h3><?= h($projectPeriod->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= $projectPeriod->has('company') ? $this->Html->link($projectPeriod->company->name, ['controller' => 'Companies', 'action' => 'view', $projectPeriod->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Project') ?></th>
            <td><?= $projectPeriod->has('project') ? $this->Html->link($projectPeriod->project->id, ['controller' => 'Projects', 'action' => 'view', $projectPeriod->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Created User') ?></th>
            <td><?= h($projectPeriod->created_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified User') ?></th>
            <td><?= h($projectPeriod->modified_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($projectPeriod->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Start') ?></th>
            <td><?= h($projectPeriod->start) ?></td>
        </tr>
        <tr>
            <th><?= __('End') ?></th>
            <td><?= h($projectPeriod->end) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($projectPeriod->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($projectPeriod->modified) ?></td>
        </tr>
    </table>
</div>
