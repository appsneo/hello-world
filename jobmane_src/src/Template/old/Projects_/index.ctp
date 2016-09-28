<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Project'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="projects index large-9 medium-8 columns content">
    <h3><?= __('Projects') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('num') ?></th>
                <th><?= $this->Paginator->sort('secondar') ?></th>
                <th><?= $this->Paginator->sort('project_name') ?></th>
                <th><?= $this->Paginator->sort('sub-title') ?></th>
                <th><?= $this->Paginator->sort('money') ?></th>
                <th><?= $this->Paginator->sort('start') ?></th>
                <th><?= $this->Paginator->sort('end') ?></th>
                <th><?= $this->Paginator->sort('address') ?></th>
                <th><?= $this->Paginator->sort('summary') ?></th>
                <th><?= $this->Paginator->sort('charge') ?></th>
                <th><?= $this->Paginator->sort('workers') ?></th>
                <th><?= $this->Paginator->sort('memo') ?></th>
                <th><?= $this->Paginator->sort('select_file') ?></th>
                <th><?= $this->Paginator->sort('completino_check') ?></th>
                <th><?= $this->Paginator->sort('created_user') ?></th>
                <th><?= $this->Paginator->sort('modified_user') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
            <tr>
                <td><?= $this->Number->format($project->id) ?></td>
                <td><?= h($project->num) ?></td>
                <td><?= h($project->secondar) ?></td>
                <td><?= h($project->project_name) ?></td>
                <td><?= h($project->sub-title) ?></td>
                <td><?= h($project->money) ?></td>
                <td><?= h($project->start) ?></td>
                <td><?= h($project->end) ?></td>
                <td><?= h($project->address) ?></td>
                <td><?= h($project->summary) ?></td>
                <td><?= h($project->charge) ?></td>
                <td><?= h($project->workers) ?></td>
                <td><?= h($project->memo) ?></td>
                <td><?= h($project->select_file) ?></td>
                <td><?= h($project->completino_check) ?></td>
                <td><?= h($project->created_user) ?></td>
                <td><?= h($project->modified_user) ?></td>
                <td><?= h($project->created) ?></td>
                <td><?= h($project->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $project->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $project->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?>
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
