<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Projects User'), ['action' => 'edit', $projectsUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Projects User'), ['action' => 'delete', $projectsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectsUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Projects Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Projects User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="projectsUsers view large-9 medium-8 columns content">
    <h3><?= h($projectsUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Project') ?></th>
            <td><?= $projectsUser->has('project') ? $this->Html->link($projectsUser->project->id, ['controller' => 'Projects', 'action' => 'view', $projectsUser->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $projectsUser->has('user') ? $this->Html->link($projectsUser->user->id, ['controller' => 'Users', 'action' => 'view', $projectsUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Created User') ?></th>
            <td><?= h($projectsUser->created_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified User') ?></th>
            <td><?= h($projectsUser->modified_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($projectsUser->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($projectsUser->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($projectsUser->modified) ?></td>
        </tr>
    </table>
</div>
