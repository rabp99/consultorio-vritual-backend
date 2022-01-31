<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Medicine[]|\Cake\Collection\CollectionInterface $medicines
 */
?>
<div class="medicines index content">
    <?= $this->Html->link(__('New Medicine'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Medicines') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('presentation') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($medicines as $medicine): ?>
                <tr>
                    <td><?= $this->Number->format($medicine->id) ?></td>
                    <td><?= h($medicine->description) ?></td>
                    <td><?= h($medicine->presentation) ?></td>
                    <td><?= h($medicine->created) ?></td>
                    <td><?= h($medicine->modified) ?></td>
                    <td><?= h($medicine->state) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $medicine->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $medicine->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $medicine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $medicine->id)]) ?>
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
