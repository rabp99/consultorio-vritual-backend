<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppointmentsImagingExam $appointmentsImagingExam
 * @var \Cake\Collection\CollectionInterface|string[] $appointments
 * @var \Cake\Collection\CollectionInterface|string[] $imagingExams
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Appointments Imaging Exams'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="appointmentsImagingExams form content">
            <?= $this->Form->create($appointmentsImagingExam) ?>
            <fieldset>
                <legend><?= __('Add Appointments Imaging Exam') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
