<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppointmentsLaboratoryExam $appointmentsLaboratoryExam
 * @var \Cake\Collection\CollectionInterface|string[] $appointments
 * @var \Cake\Collection\CollectionInterface|string[] $laboratoryExams
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Appointments Laboratory Exams'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="appointmentsLaboratoryExams form content">
            <?= $this->Form->create($appointmentsLaboratoryExam) ?>
            <fieldset>
                <legend><?= __('Add Appointments Laboratory Exam') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
