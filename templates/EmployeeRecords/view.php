<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmployeeRecord $employeeRecord
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Employee Record'), ['action' => 'edit', $employeeRecord->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Employee Record'), ['action' => 'delete', $employeeRecord->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employeeRecord->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Employee Records'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Employee Record'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="employeeRecords view content">
            <h3><?= h($employeeRecord->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Employee Person Doc Type') ?></th>
                    <td><?= h($employeeRecord->employee_person_doc_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Employee Person Doc Num') ?></th>
                    <td><?= h($employeeRecord->employee_person_doc_num) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($employeeRecord->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start') ?></th>
                    <td><?= h($employeeRecord->start) ?></td>
                </tr>
                <tr>
                    <th><?= __('End') ?></th>
                    <td><?= h($employeeRecord->end) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($employeeRecord->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($employeeRecord->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
