<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmployeeRecord $employeeRecord
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $employeeRecord->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $employeeRecord->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Employee Records'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="employeeRecords form content">
            <?= $this->Form->create($employeeRecord) ?>
            <fieldset>
                <legend><?= __('Edit Employee Record') ?></legend>
                <?php
                    echo $this->Form->control('employee_person_doc_type');
                    echo $this->Form->control('employee_person_doc_num');
                    echo $this->Form->control('start');
                    echo $this->Form->control('end', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
