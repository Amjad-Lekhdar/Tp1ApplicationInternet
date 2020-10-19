<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule[]|\Cake\Collection\CollectionInterface $schedules
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Schedule'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="schedules index large-9 medium-8 columns content">
    <h3><?= __('Schedules') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                
                <th scope="col"><?= $this->Paginator->sort('Name_schedule') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Schedule_Description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Schedule_End_Date_Time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Schedule_Start_Date_Time') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($schedules as $schedule): ?>
            <tr>
                
                
                <td><?= h($schedule->Name_schedule) ?></td>
                <td><?= h($schedule->Schedule_Description) ?></td>
                <td><?= h($schedule->Schedule_End_Date_Time) ?></td>
                <td><?= h($schedule->Schedule_Start_Date_Time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $schedule->Schedule_ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $schedule->Schedule_ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $schedule->Schedule_ID], ['confirm' => __('Are you sure you want to delete # {0}?', $schedule->Schedule_ID)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
