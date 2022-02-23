<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppointmentsLaboratoryExam[]|\Cake\Collection\CollectionInterface $appointmentsLaboratoryExams
 */
?>
<div class="appointmentsLaboratoryExams index content">
    <?= $this->Html->link(__('New Appointments Laboratory Exam'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Appointments Laboratory Exams') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('appointment_id') ?></th>
                    <th><?= $this->Paginator->sort('laboratory_exam_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointmentsLaboratoryExams as $appointmentsLaboratoryExam): ?>
                <tr>
                    <td><?= $appointmentsLaboratoryExam->has('appointment') ? $this->Html->link($appointmentsLaboratoryExam->appointment->appointment_date, ['controller' => 'Appointments', 'action' => 'view', $appointmentsLaboratoryExam->appointment->id]) : '' ?></td>
                    <td><?= $appointmentsLaboratoryExam->has('laboratory_exam') ? $this->Html->link($appointmentsLaboratoryExam->laboratory_exam->id, ['controller' => 'LaboratoryExams', 'action' => 'view', $appointmentsLaboratoryExam->laboratory_exam->id]) : '' ?></td>
                    <td><?= h($appointmentsLaboratoryExam->created) ?></td>
                    <td><?= h($appointmentsLaboratoryExam->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $appointmentsLaboratoryExam->appointment_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $appointmentsLaboratoryExam->appointment_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $appointmentsLaboratoryExam->appointment_id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointmentsLaboratoryExam->appointment_id)]) ?>
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
