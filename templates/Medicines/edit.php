<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Medicine $medicine
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $medicine->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $medicine->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Medicines'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="medicines form content">
            <?= $this->Form->create($medicine) ?>
            <fieldset>
                <legend><?= __('Edit Medicine') ?></legend>
                <?php
                    echo $this->Form->control('description');
                    echo $this->Form->control('presentation');
                    echo $this->Form->control('state');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
