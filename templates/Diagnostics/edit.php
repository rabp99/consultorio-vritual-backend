<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Diagnostic $diagnostic
 * @var string[]|\Cake\Collection\CollectionInterface $appointments
 * @var string[]|\Cake\Collection\CollectionInterface $diseases
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $diagnostic->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $diagnostic->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Diagnostics'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="diagnostics form content">
            <?= $this->Form->create($diagnostic) ?>
            <fieldset>
                <legend><?= __('Edit Diagnostic') ?></legend>
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
