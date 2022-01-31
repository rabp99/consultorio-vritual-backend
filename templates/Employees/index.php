<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
 */
?>
<div class="employees index content">
    <?= $this->Html->link(__('New Employee'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Employees') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('person_doc_type') ?></th>
                    <th><?= $this->Paginator->sort('person_doc_num') ?></th>
                    <th><?= $this->Paginator->sort('cmp') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?= h($employee->person_doc_type) ?></td>
                    <td><?= h($employee->person_doc_num) ?></td>
                    <td><?= h($employee->cmp) ?></td>
                    <td><?= h($employee->created) ?></td>
                    <td><?= h($employee->modified) ?></td>
                    <td><?= h($employee->state) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $employee->person_doc_type]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $employee->person_doc_type]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $employee->person_doc_type], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->person_doc_type)]) ?>
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
