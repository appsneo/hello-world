<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users001'), ['action' => 'edit', $users001->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users001'), ['action' => 'delete', $users001->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users001->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users001'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users001'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users001 view large-9 medium-8 columns content">
    <h3><?= h($users001->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($users001->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($users001->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($users001->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= h($users001->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Blood Type') ?></th>
            <td><?= h($users001->blood_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Emergency') ?></th>
            <td><?= h($users001->emergency) ?></td>
        </tr>
        <tr>
            <th><?= __('Capbilities') ?></th>
            <td><?= h($users001->capbilities) ?></td>
        </tr>
        <tr>
            <th><?= __('Safety') ?></th>
            <td><?= h($users001->safety) ?></td>
        </tr>
        <tr>
            <th><?= __('Created User') ?></th>
            <td><?= h($users001->created_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified User') ?></th>
            <td><?= h($users001->modified_user) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($users001->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Medical Checked Date') ?></th>
            <td><?= h($users001->medical_checked_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Joined Date') ?></th>
            <td><?= h($users001->joined_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Leaving Date') ?></th>
            <td><?= h($users001->leaving_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Birth Date') ?></th>
            <td><?= h($users001->birth_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($users001->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($users001->modified) ?></td>
        </tr>
    </table>
</div>
