<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="projects form large-9 medium-8 columns content">
    <?= $this->Form->create($project) ?>
    <fieldset>
        <legend><?= __('Add Project') ?></legend>
        <?php
            echo $this->Form->input('num');
            echo $this->Form->input('secondar');
            echo $this->Form->input('project_name');
            echo $this->Form->input('sub-title');
            echo $this->Form->input('money');
            echo $this->Form->input('start');
            echo $this->Form->input('end');
            echo $this->Form->input('address');
            echo $this->Form->input('summary');
            echo $this->Form->input('charge');
            echo $this->Form->input('workers');
            echo $this->Form->input('memo');
            echo $this->Form->input('select_file');
            echo $this->Form->input('completino_check');
            echo $this->Form->input('created_user');
            echo $this->Form->input('modified_user');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
