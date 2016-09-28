<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $how->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $how->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Hows'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="hows form large-9 medium-8 columns content">
    <?= $this->Form->create($how) ?>
    <fieldset>
        <legend><?= __('Edit How') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
