<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppointmentsLaboratoryExam $appointmentsLaboratoryExam
 * @var string[]|\Cake\Collection\CollectionInterface $appointments
 * @var string[]|\Cake\Collection\CollectionInterface $laboratoryExams
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $appointmentsLaboratoryExam->appointment_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $appointmentsLaboratoryExam->appointment_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Appointments Laboratory Exams'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="appointmentsLaboratoryExams form content">
            <?= $this->Form->create($appointmentsLaboratoryExam) ?>
            <fieldset>
                <legend><?= __('Edit Appointments Laboratory Exam') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
