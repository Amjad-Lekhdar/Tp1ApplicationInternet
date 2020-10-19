<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schedules'), ['controller' => 'Schedules', 'action' => 'index']) ?> </li>

        <li><?php
            $this->request->session()->write('Employee.id', $employee->id);
            $this->request->session()->write('Employee.slug', $employee->slug);
            echo $this->Html->link(__('New Schedule'), ['controller' => 'Schedules', 'action' => 'add']);
            ?></li>
        <li>
            <?php
            $this->request->session()->write('Employee.id', $employee->id);
            $this->request->session()->write('Employee.slug', $employee->slug);
            echo $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']);
            ?>


        </li>

        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>

        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="employees view large-9 medium-8 columns content">
    <h3><?= h($employee->First_Name)  ?> <?= h($employee->Last_Name)  ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($employee->First_Name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($employee->Last_Name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gender') ?></th>
            <td><?= h($employee->Gender) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Started Employement') ?></th>
            <td><?= h($employee->Date_Started_Employement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Left Employement') ?></th>
            <td><?= h($employee->Date_Left_Employement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($employee->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($employee->created) ?></td>
        </tr>
        
    </table>
    <div class="related">
        <h4><?= __('Related Roles') ?></h4>
        <?php if (!empty($employee->roles)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    
                    <th scope="col"><?= __('Role Name') ?></th>
                    <th scope="col"><?= __('Role Description') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($employee->roles as $roles): ?>
                    <tr>
                        
                        <td><?= h($roles->Role_Name) ?></td>
                        <td><?= h($roles->Role_Description) ?></td>
                        <td><?= h($roles->created) ?></td>
                        <td><?= h($roles->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Roles', 'action' => 'view', $roles->Role_id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Roles', 'action' => 'edit', $roles->Role_id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Roles', 'action' => 'delete', $roles->Role_id], ['confirm' => __('Are you sure you want to delete # {0}?', $roles->Role_id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Files') ?></h4>
        <?php if (!empty($employee->files)): ?>
            <table cellpadding="0" cellspacing="0">
                <?php foreach ($employee->files as $files): ?>
                    <tr>
                        <td>    <?php
                            echo $this->Html->image($files->path . $files->name, [
                                "alt" => $files->name,
                            ]);
                            ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Schedules') ?></h4>
        <?php if (!empty($employee->schedules)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    
                    <th scope="col"><?= __('Name Schedule') ?></th>
                    <th scope="col"><?= __('Schedule Description') ?></th>
                    <th scope="col"><?= __('Schedule End Date Time') ?></th>
                    <th scope="col"><?= __('Schedule Start Date Time') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($employee->schedules as $schedules): ?>
                    <tr>
                        
                        <td><?= h($schedules->Name_schedule) ?></td>
                        <td><?= h($schedules->Schedule_Description) ?></td>
                        <td><?= h($schedules->Schedule_End_Date_Time) ?></td>
                        <td><?= h($schedules->Schedule_Start_Date_Time) ?></td>
                        <td><?= h($schedules->modified) ?></td>
                        <td><?= h($schedules->created) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Schedules', 'action' => 'view', $schedules->Schedule_ID]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Schedules', 'action' => 'edit', $schedules->Schedule_ID]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Schedules', 'action' => 'delete', $schedules->Schedule_ID], ['confirm' => __('Are you sure you want to delete # {0}?', $schedules->Schedule_ID)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
