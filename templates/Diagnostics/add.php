<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Diagnostic $diagnostic
 * @var \Cake\Collection\CollectionInterface|string[] $appointments
 * @var \Cake\Collection\CollectionInterface|string[] $diseases
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Diagnostics'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="diagnostics form content">
            <?= $this->Form->create($diagnostic) ?>
            <fieldset>
                <legend><?= __('Add Diagnostic') ?></legend>
                <?php
                    echo $this->Form->control('appointment_id', ['options' => $appointments]);
                    echo $this->Form->control('disease_id', ['options' => $diseases]);
                    echo $this->Form->control('state');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
