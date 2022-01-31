<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConsultingRoom $consultingRoom
 * @var \Cake\Collection\CollectionInterface|string[] $places
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Consulting Rooms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="consultingRooms form content">
            <?= $this->Form->create($consultingRoom) ?>
            <fieldset>
                <legend><?= __('Add Consulting Room') ?></legend>
                <?php
                    echo $this->Form->control('description');
                    echo $this->Form->control('floor');
                    echo $this->Form->control('place_id', ['options' => $places]);
                    echo $this->Form->control('state');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
