<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ImagingExam $imagingExam
 * @var string[]|\Cake\Collection\CollectionInterface $appointments
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $imagingExam->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $imagingExam->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Imaging Exams'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="imagingExams form content">
            <?= $this->Form->create($imagingExam) ?>
            <fieldset>
                <legend><?= __('Edit Imaging Exam') ?></legend>
                <?php
                    echo $this->Form->control('description');
                    echo $this->Form->control('state');
                    echo $this->Form->control('appointments._ids', ['options' => $appointments]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
