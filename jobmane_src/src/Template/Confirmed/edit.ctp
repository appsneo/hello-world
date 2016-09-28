<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $confirmed->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $confirmed->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Confirmed'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Confirmed'), ['controller' => 'Confirmed', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Confirmed'), ['controller' => 'Confirmed', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="confirmed form large-9 medium-8 columns content">
    <?= $this->Form->create($confirmed) ?>
    <fieldset>
        <legend><?= __('Edit Confirmed') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('confirmed_id');
            echo $this->Form->input('expired_date');
            echo $this->Form->input('created_user');
            echo $this->Form->input('modified_user');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
