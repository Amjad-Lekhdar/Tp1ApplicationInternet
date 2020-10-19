<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Statut $statut
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $statut->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $statut->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Statut'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="statut form large-9 medium-8 columns content">
    <?= $this->Form->create($statut) ?>
    <fieldset>
        <legend><?= __('Edit Statut') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
