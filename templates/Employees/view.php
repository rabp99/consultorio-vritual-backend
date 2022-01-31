<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->person_doc_type], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->person_doc_type], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->person_doc_type), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Employees'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Employee'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="employees view content">
            <h3><?= h($employee->person_doc_type) ?></h3>
            <table>
                <tr>
                    <th><?= __('Person Doc Type') ?></th>
                    <td><?= h($employee->person_doc_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Person Doc Num') ?></th>
                    <td><?= h($employee->person_doc_num) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cmp') ?></th>
                    <td><?= h($employee->cmp) ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($employee->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($employee->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($employee->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
