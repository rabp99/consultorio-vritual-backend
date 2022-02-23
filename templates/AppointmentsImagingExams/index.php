<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppointmentsImagingExam[]|\Cake\Collection\CollectionInterface $appointmentsImagingExams
 */
?>
<div class="appointmentsImagingExams index content">
    <?= $this->Html->link(__('New Appointments Imaging Exam'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Appointments Imaging Exams') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('appointment_id') ?></th>
                    <th><?= $this->Paginator->sort('imaging_exam_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointmentsImagingExams as $appointmentsImagingExam): ?>
                <tr>
                    <td><?= $appointmentsImagingExam->has('appointment') ? $this->Html->link($appointmentsImagingExam->appointment->appointment_date, ['controller' => 'Appointments', 'action' => 'view', $appointmentsImagingExam->appointment->id]) : '' ?></td>
                    <td><?= $appointmentsImagingExam->has('imaging_exam') ? $this->Html->link($appointmentsImagingExam->imaging_exam->id, ['controller' => 'ImagingExams', 'action' => 'view', $appointmentsImagingExam->imaging_exam->id]) : '' ?></td>
                    <td><?= h($appointmentsImagingExam->created) ?></td>
                    <td><?= h($appointmentsImagingExam->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $appointmentsImagingExam->appointment_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $appointmentsImagingExam->appointment_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $appointmentsImagingExam->appointment_id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointmentsImagingExam->appointment_id)]) ?>
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
