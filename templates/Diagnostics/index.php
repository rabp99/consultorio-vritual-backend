<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Diagnostic[]|\Cake\Collection\CollectionInterface $diagnostics
 */
?>
<div class="diagnostics index content">
    <?= $this->Html->link(__('New Diagnostic'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Diagnostics') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('appointment_id') ?></th>
                    <th><?= $this->Paginator->sort('disease_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($diagnostics as $diagnostic): ?>
                <tr>
                    <td><?= $this->Number->format($diagnostic->id) ?></td>
                    <td><?= $diagnostic->has('appointment') ? $this->Html->link($diagnostic->appointment->id, ['controller' => 'Appointments', 'action' => 'view', $diagnostic->appointment->id]) : '' ?></td>
                    <td><?= $diagnostic->has('disease') ? $this->Html->link($diagnostic->disease->id, ['controller' => 'Diseases', 'action' => 'view', $diagnostic->disease->id]) : '' ?></td>
                    <td><?= h($diagnostic->created) ?></td>
                    <td><?= h($diagnostic->modified) ?></td>
                    <td><?= h($diagnostic->state) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $diagnostic->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $diagnostic->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $diagnostic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diagnostic->id)]) ?>
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
