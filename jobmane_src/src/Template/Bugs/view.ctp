<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bug'), ['action' => 'edit', $bug->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bug'), ['action' => 'delete', $bug->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bug->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bugs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bug'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bugs view large-9 medium-8 columns content">
    <h3><?= h($bug->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Wr User Id') ?></th>
            <td><?= h($bug->wr_user_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Up User Id') ?></th>
            <td><?= h($bug->up_user_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Wr Note') ?></th>
            <td><?= h($bug->wr_note) ?></td>
        </tr>
        <tr>
            <th><?= __('Up Note') ?></th>
            <td><?= h($bug->up_note) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($bug->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= h($bug->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Created User') ?></th>
            <td><?= h($bug->created_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified User') ?></th>
            <td><?= h($bug->modified_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($bug->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Wr Date') ?></th>
            <td><?= h($bug->wr_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Up Date') ?></th>
            <td><?= h($bug->up_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($bug->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($bug->modified) ?></td>
        </tr>
    </table>
</div>
