<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule $schedule
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Schedule'), ['action' => 'edit', $schedule->Schedule_ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Schedule'), ['action' => 'delete', $schedule->Schedule_ID], ['confirm' => __('Are you sure you want to delete # {0}?', $schedule->Schedule_ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Schedules'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Schedule'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="schedules view large-9 medium-8 columns content">
    
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name schedule') ?></th>
            <td><?= h($schedule->Name_schedule) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Schedule Description') ?></th>
            <td><?= h($schedule->Schedule_Description) ?></td>
        </tr>
       <tr>
            <th scope="row"><?= __('Schedule End Date Time') ?></th>
            <td><?= h($schedule->Schedule_End_Date_Time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Schedule Start Date Time') ?></th>
            <td><?= h($schedule->Schedule_Start_Date_Time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('modified') ?></th>
            <td><?= h($schedule->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('created') ?></th>
            <td><?= h($schedule->created) ?></td>
        </tr>
    </table>
</div>
