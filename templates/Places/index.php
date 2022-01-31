<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Place[]|\Cake\Collection\CollectionInterface $places
 */
?>
<div class="places index content">
    <?= $this->Html->link(__('New Place'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Places') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('address') ?></th>
                    <th><?= $this->Paginator->sort('latitude') ?></th>
                    <th><?= $this->Paginator->sort('longitude') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($places as $place): ?>
                <tr>
                    <td><?= $this->Number->format($place->id) ?></td>
                    <td><?= h($place->description) ?></td>
                    <td><?= h($place->address) ?></td>
                    <td><?= h($place->latitude) ?></td>
                    <td><?= h($place->longitude) ?></td>
                    <td><?= h($place->created) ?></td>
                    <td><?= h($place->modified) ?></td>
                    <td><?= h($place->state) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $place->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $place->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $place->id], ['confirm' => __('Are you sure you want to delete # {0}?', $place->id)]) ?>
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
