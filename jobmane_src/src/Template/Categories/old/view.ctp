<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categories view large-9 medium-8 columns content">
    <h3><?= h($category->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= $category->has('company') ? $this->Html->link($category->company->name, ['controller' => 'Companies', 'action' => 'view', $category->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($category->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Created User') ?></th>
            <td><?= h($category->created_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified User') ?></th>
            <td><?= h($category->modified_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($category->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($category->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($category->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Projects') ?></h4>
        <?php if (!empty($category->projects)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Company Id') ?></th>
                <th><?= __('Num') ?></th>
                <th><?= __('Project Name') ?></th>
                <th><?= __('Client') ?></th>
                <th><?= __('Secondary') ?></th>
                <th><?= __('Category Id') ?></th>
                <th><?= __('Money') ?></th>
                <th><?= __('Start') ?></th>
                <th><?= __('End') ?></th>
                <th><?= __('Address') ?></th>
                <th><?= __('Summary') ?></th>
                <th><?= __('Charge') ?></th>
                <th><?= __('Memo') ?></th>
                <th><?= __('Select File') ?></th>
                <th><?= __('Completion Check') ?></th>
                <th><?= __('Color') ?></th>
                <th><?= __('Created User') ?></th>
                <th><?= __('Modified User') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($category->projects as $projects): ?>
            <tr>
                <td><?= h($projects->id) ?></td>
                <td><?= h($projects->company_id) ?></td>
                <td><?= h($projects->num) ?></td>
                <td><?= h($projects->project_name) ?></td>
                <td><?= h($projects->client) ?></td>
                <td><?= h($projects->secondary) ?></td>
                <td><?= h($projects->category_id) ?></td>
                <td><?= h($projects->money) ?></td>
                <td><?= h($projects->start) ?></td>
                <td><?= h($projects->end) ?></td>
                <td><?= h($projects->address) ?></td>
                <td><?= h($projects->summary) ?></td>
                <td><?= h($projects->charge) ?></td>
                <td><?= h($projects->memo) ?></td>
                <td><?= h($projects->select_file) ?></td>
                <td><?= h($projects->completion_check) ?></td>
                <td><?= h($projects->color) ?></td>
                <td><?= h($projects->created_user) ?></td>
                <td><?= h($projects->modified_user) ?></td>
                <td><?= h($projects->created) ?></td>
                <td><?= h($projects->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Projects', 'action' => 'view', $projects->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Projects', 'action' => 'edit', $projects->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Projects', 'action' => 'delete', $projects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projects->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
