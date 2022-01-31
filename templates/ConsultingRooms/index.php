<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConsultingRoom[]|\Cake\Collection\CollectionInterface $consultingRooms
 */
?>
<div class="consultingRooms index content">
    <?= $this->Html->link(__('New Consulting Room'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Consulting Rooms') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('floor') ?></th>
                    <th><?= $this->Paginator->sort('place_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultingRooms as $consultingRoom): ?>
                <tr>
                    <td><?= $this->Number->format($consultingRoom->id) ?></td>
                    <td><?= h($consultingRoom->description) ?></td>
                    <td><?= h($consultingRoom->floor) ?></td>
                    <td><?= $consultingRoom->has('place') ? $this->Html->link($consultingRoom->place->id, ['controller' => 'Places', 'action' => 'view', $consultingRoom->place->id]) : '' ?></td>
                    <td><?= h($consultingRoom->created) ?></td>
                    <td><?= h($consultingRoom->modified) ?></td>
                    <td><?= h($consultingRoom->state) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $consultingRoom->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $consultingRoom->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $consultingRoom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $consultingRoom->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
