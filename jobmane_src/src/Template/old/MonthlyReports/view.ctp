<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Monthly Report'), ['action' => 'edit', $monthlyReport->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Monthly Report'), ['action' => 'delete', $monthlyReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $monthlyReport->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Monthly Reports'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Monthly Report'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="monthlyReports view large-9 medium-8 columns content">
    <h3><?= h($monthlyReport->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= $monthlyReport->has('company') ? $this->Html->link($monthlyReport->company->name, ['controller' => 'Companies', 'action' => 'view', $monthlyReport->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Project') ?></th>
            <td><?= $monthlyReport->has('project') ? $this->Html->link($monthlyReport->project->id, ['controller' => 'Projects', 'action' => 'view', $monthlyReport->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $monthlyReport->has('user') ? $this->Html->link($monthlyReport->user->id, ['controller' => 'Users', 'action' => 'view', $monthlyReport->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Created User') ?></th>
            <td><?= h($monthlyReport->created_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified User') ?></th>
            <td><?= h($monthlyReport->modified_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($monthlyReport->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Month') ?></th>
            <td><?= h($monthlyReport->month) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($monthlyReport->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($monthlyReport->modified) ?></td>
        </tr>
    </table>
</div>
