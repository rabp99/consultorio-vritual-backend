<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppointmentsLaboratoryExam $appointmentsLaboratoryExam
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Appointments Laboratory Exam'), ['action' => 'edit', $appointmentsLaboratoryExam->appointment_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Appointments Laboratory Exam'), ['action' => 'delete', $appointmentsLaboratoryExam->appointment_id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointmentsLaboratoryExam->appointment_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Appointments Laboratory Exams'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Appointments Laboratory Exam'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="appointmentsLaboratoryExams view content">
            <h3><?= h($appointmentsLaboratoryExam->appointment_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Appointment') ?></th>
                    <td><?= $appointmentsLaboratoryExam->has('appointment') ? $this->Html->link($appointmentsLaboratoryExam->appointment->appointment_date, ['controller' => 'Appointments', 'action' => 'view', $appointmentsLaboratoryExam->appointment->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Laboratory Exam') ?></th>
                    <td><?= $appointmentsLaboratoryExam->has('laboratory_exam') ? $this->Html->link($appointmentsLaboratoryExam->laboratory_exam->id, ['controller' => 'LaboratoryExams', 'action' => 'view', $appointmentsLaboratoryExam->laboratory_exam->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($appointmentsLaboratoryExam->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($appointmentsLaboratoryExam->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
