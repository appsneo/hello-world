<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Report Material'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reports'), ['controller' => 'Reports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Report'), ['controller' => 'Reports', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reportMaterials index large-9 medium-8 columns content">
    <h3><?= __('Report Materials') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('company_id') ?></th>
                <th><?= $this->Paginator->sort('report_id') ?></th>
                <th><?= $this->Paginator->sort('material_id') ?></th>
                <th><?= $this->Paginator->sort('material_name') ?></th>
                <th><?= $this->Paginator->sort('quantity') ?></th>
                <th><?= $this->Paginator->sort('created_user') ?></th>
                <th><?= $this->Paginator->sort('modified_user') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reportMaterials as $reportMaterial): ?>
            <tr>
                <td><?= $this->Number->format($reportMaterial->id) ?></td>
                <td><?= $reportMaterial->has('company') ? $this->Html->link($reportMaterial->company->name, ['controller' => 'Companies', 'action' => 'view', $reportMaterial->company->id]) : '' ?></td>
                <td><?= $reportMaterial->has('report') ? $this->Html->link($reportMaterial->report->id, ['controller' => 'Reports', 'action' => 'view', $reportMaterial->report->id]) : '' ?></td>
                <td><?= $reportMaterial->has('material') ? $this->Html->link($reportMaterial->material->name, ['controller' => 'Materials', 'action' => 'view', $reportMaterial->material->id]) : '' ?></td>
                <td><?= h($reportMaterial->material_name) ?></td>
                <td><?= $this->Number->format($reportMaterial->quantity) ?></td>
                <td><?= h($reportMaterial->created_user) ?></td>
                <td><?= h($reportMaterial->modified_user) ?></td>
                <td><?= h($reportMaterial->created) ?></td>
                <td><?= h($reportMaterial->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $reportMaterial->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reportMaterial->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reportMaterial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reportMaterial->id)]) ?>
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
