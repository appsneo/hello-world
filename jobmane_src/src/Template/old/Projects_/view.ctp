<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Project'), ['action' => 'edit', $project->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Project'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="projects view large-9 medium-8 columns content">
    <h3><?= h($project->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Num') ?></th>
            <td><?= h($project->num) ?></td>
        </tr>
        <tr>
            <th><?= __('Secondar') ?></th>
            <td><?= h($project->secondar) ?></td>
        </tr>
        <tr>
            <th><?= __('Project Name') ?></th>
            <td><?= h($project->project_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Sub-title') ?></th>
            <td><?= h($project->sub-title) ?></td>
        </tr>
        <tr>
            <th><?= __('Money') ?></th>
            <td><?= h($project->money) ?></td>
        </tr>
        <tr>
            <th><?= __('Start') ?></th>
            <td><?= h($project->start) ?></td>
        </tr>
        <tr>
            <th><?= __('End') ?></th>
            <td><?= h($project->end) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($project->address) ?></td>
        </tr>
        <tr>
            <th><?= __('Summary') ?></th>
            <td><?= h($project->summary) ?></td>
        </tr>
        <tr>
            <th><?= __('Charge') ?></th>
            <td><?= h($project->charge) ?></td>
        </tr>
        <tr>
            <th><?= __('Workers') ?></th>
            <td><?= h($project->workers) ?></td>
        </tr>
        <tr>
            <th><?= __('Memo') ?></th>
            <td><?= h($project->memo) ?></td>
        </tr>
        <tr>
            <th><?= __('Select File') ?></th>
            <td><?= h($project->select_file) ?></td>
        </tr>
        <tr>
            <th><?= __('Completino Check') ?></th>
            <td><?= h($project->completino_check) ?></td>
        </tr>
        <tr>
            <th><?= __('Created User') ?></th>
            <td><?= h($project->created_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified User') ?></th>
            <td><?= h($project->modified_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($project->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($project->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($project->modified) ?></td>
        </tr>
    </table>
</div>
