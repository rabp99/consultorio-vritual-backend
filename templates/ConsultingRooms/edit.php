<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConsultingRoom $consultingRoom
 * @var string[]|\Cake\Collection\CollectionInterface $places
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $consultingRoom->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $consultingRoom->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Consulting Rooms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="consultingRooms form content">
            <?= $this->Form->create($consultingRoom) ?>
            <fieldset>
                <legend><?= __('Edit Consulting Room') ?></legend>
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
