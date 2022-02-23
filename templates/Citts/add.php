<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Citt $citt
 * @var \Cake\Collection\CollectionInterface|string[] $appointments
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Citts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="citts form content">
            <?= $this->Form->create($citt) ?>
            <fieldset>
                <legend><?= __('Add Citt') ?></legend>
                <?php
                    echo $this->Form->control('appointment_id', ['options' => $appointments]);
                    echo $this->Form->control('start_date');
                    echo $this->Form->control('end_date');
                    echo $this->Form->control('number_days');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
