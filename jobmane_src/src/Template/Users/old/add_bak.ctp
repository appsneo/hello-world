<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('companyid');
            echo $this->Form->input('birthday', ['empty' => true]);
            echo $this->Form->input('boad');
            echo $this->Form->input('password');
            echo $this->Form->input('photo');
            echo $this->Form->input('kensin', ['empty' => true]);
            echo $this->Form->input('indate', ['empty' => true]);
            echo $this->Form->input('outdate', ['empty' => true]);
            echo $this->Form->input('phonenumber');
            echo $this->Form->input('smartphone');
            echo $this->Form->input('email');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
