<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppointmentsImagingExam $appointmentsImagingExam
 * @var string[]|\Cake\Collection\CollectionInterface $appointments
 * @var string[]|\Cake\Collection\CollectionInterface $imagingExams
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $appointmentsImagingExam->appointment_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $appointmentsImagingExam->appointment_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Appointments Imaging Exams'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="appointmentsImagingExams form content">
            <?= $this->Form->create($appointmentsImagingExam) ?>
            <fieldset>
                <legend><?= __('Edit Appointments Imaging Exam') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
