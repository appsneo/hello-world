<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit How'), ['action' => 'edit', $how->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete How'), ['action' => 'delete', $how->id], ['confirm' => __('Are you sure you want to delete # {0}?', $how->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New How'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="hows view large-9 medium-8 columns content">
    <h3><?= h($how->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($how->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($how->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($how->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($how->modified) ?></td>
        </tr>
    </table>
</div>
