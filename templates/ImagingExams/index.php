<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ImagingExam[]|\Cake\Collection\CollectionInterface $imagingExams
 */
?>
<div class="imagingExams index content">
    <?= $this->Html->link(__('New Imaging Exam'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Imaging Exams') ?></h3>
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
                <?php foreach ($imagingExams as $imagingExam): ?>
                <tr>
                    <td><?= $this->Number->format($imagingExam->id) ?></td>
                    <td><?= h($imagingExam->description) ?></td>
                    <td><?= h($imagingExam->created) ?></td>
                    <td><?= h($imagingExam->modified) ?></td>
                    <td><?= h($imagingExam->state) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $imagingExam->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $imagingExam->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $imagingExam->id], ['confirm' => __('Are you sure you want to delete # {0}?', $imagingExam->id)]) ?>
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
