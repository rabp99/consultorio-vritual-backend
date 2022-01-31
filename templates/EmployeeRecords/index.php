<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmployeeRecord[]|\Cake\Collection\CollectionInterface $employeeRecords
 */
?>
<div class="employeeRecords index content">
    <?= $this->Html->link(__('New Employee Record'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Employee Records') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('employee_person_doc_type') ?></th>
                    <th><?= $this->Paginator->sort('employee_person_doc_num') ?></th>
                    <th><?= $this->Paginator->sort('start') ?></th>
                    <th><?= $this->Paginator->sort('end') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employeeRecords as $employeeRecord): ?>
                <tr>
                    <td><?= $this->Number->format($employeeRecord->id) ?></td>
                    <td><?= h($employeeRecord->employee_person_doc_type) ?></td>
                    <td><?= h($employeeRecord->employee_person_doc_num) ?></td>
                    <td><?= h($employeeRecord->start) ?></td>
                    <td><?= h($employeeRecord->end) ?></td>
                    <td><?= h($employeeRecord->created) ?></td>
                    <td><?= h($employeeRecord->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $employeeRecord->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $employeeRecord->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $employeeRecord->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employeeRecord->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
