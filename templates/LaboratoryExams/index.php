<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LaboratoryExam[]|\Cake\Collection\CollectionInterface $laboratoryExams
 */
?>
<div class="laboratoryExams index content">
    <?= $this->Html->link(__('New Laboratory Exam'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Laboratory Exams') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($laboratoryExams as $laboratoryExam): ?>
                <tr>
                    <td><?= $this->Number->format($laboratoryExam->id) ?></td>
                    <td><?= h($laboratoryExam->description) ?></td>
                    <td><?= h($laboratoryExam->created) ?></td>
                    <td><?= h($laboratoryExam->modified) ?></td>
                    <td><?= h($laboratoryExam->state) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $laboratoryExam->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $laboratoryExam->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $laboratoryExam->id], ['confirm' => __('Are you sure you want to delete # {0}?', $laboratoryExam->id)]) ?>
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
