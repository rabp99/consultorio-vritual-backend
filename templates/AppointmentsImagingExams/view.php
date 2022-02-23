<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppointmentsImagingExam $appointmentsImagingExam
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Appointments Imaging Exam'), ['action' => 'edit', $appointmentsImagingExam->appointment_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Appointments Imaging Exam'), ['action' => 'delete', $appointmentsImagingExam->appointment_id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointmentsImagingExam->appointment_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Appointments Imaging Exams'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Appointments Imaging Exam'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="appointmentsImagingExams view content">
            <h3><?= h($appointmentsImagingExam->appointment_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Appointment') ?></th>
                    <td><?= $appointmentsImagingExam->has('appointment') ? $this->Html->link($appointmentsImagingExam->appointment->appointment_date, ['controller' => 'Appointments', 'action' => 'view', $appointmentsImagingExam->appointment->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Imaging Exam') ?></th>
                    <td><?= $appointmentsImagingExam->has('imaging_exam') ? $this->Html->link($appointmentsImagingExam->imaging_exam->id, ['controller' => 'ImagingExams', 'action' => 'view', $appointmentsImagingExam->imaging_exam->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($appointmentsImagingExam->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($appointmentsImagingExam->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
