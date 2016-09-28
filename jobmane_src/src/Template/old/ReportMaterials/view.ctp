<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Report Material'), ['action' => 'edit', $reportMaterial->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Report Material'), ['action' => 'delete', $reportMaterial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reportMaterial->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Report Materials'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Report Material'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reports'), ['controller' => 'Reports', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Report'), ['controller' => 'Reports', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reportMaterials view large-9 medium-8 columns content">
    <h3><?= h($reportMaterial->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= $reportMaterial->has('company') ? $this->Html->link($reportMaterial->company->name, ['controller' => 'Companies', 'action' => 'view', $reportMaterial->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Report') ?></th>
            <td><?= $reportMaterial->has('report') ? $this->Html->link($reportMaterial->report->id, ['controller' => 'Reports', 'action' => 'view', $reportMaterial->report->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Material') ?></th>
            <td><?= $reportMaterial->has('material') ? $this->Html->link($reportMaterial->material->name, ['controller' => 'Materials', 'action' => 'view', $reportMaterial->material->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Created User') ?></th>
            <td><?= h($reportMaterial->created_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified User') ?></th>
            <td><?= h($reportMaterial->modified_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($reportMaterial->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($reportMaterial->quantity) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($reportMaterial->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($reportMaterial->modified) ?></td>
        </tr>
    </table>
</div>
