<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users001'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users001 form large-9 medium-8 columns content">
    <?= $this->Form->create($users001) ?>
    <fieldset>
        <legend><?= __('Add Users001') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('password');
            echo $this->Form->input('email');
            echo $this->Form->input('status');
            echo $this->Form->input('blood_type');
            echo $this->Form->input('medical_checked_date', ['empty' => true]);
            echo $this->Form->input('joined_date', ['empty' => true]);
            echo $this->Form->input('leaving_date', ['empty' => true]);
            echo $this->Form->input('birth_date', ['empty' => true]);
            echo $this->Form->input('emergency');
            echo $this->Form->input('capbilities');
            echo $this->Form->input('safety');
            echo $this->Form->input('created_user');
            echo $this->Form->input('modified_user');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
