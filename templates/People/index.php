<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person[]|\Cake\Collection\CollectionInterface $people
 */
?>
<div class="people index content">
    <?= $this->Html->link(__('New Person'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('People') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('doc_type') ?></th>
                    <th><?= $this->Paginator->sort('doc_num') ?></th>
                    <th><?= $this->Paginator->sort('names') ?></th>
                    <th><?= $this->Paginator->sort('last_name1') ?></th>
                    <th><?= $this->Paginator->sort('last_name2') ?></th>
                    <th><?= $this->Paginator->sort('birth') ?></th>
                    <th><?= $this->Paginator->sort('nationality') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('gendre') ?></th>
                    <th><?= $this->Paginator->sort('tels') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($people as $person): ?>
                <tr>
                    <td><?= h($person->doc_type) ?></td>
                    <td><?= h($person->doc_num) ?></td>
                    <td><?= h($person->names) ?></td>
                    <td><?= h($person->last_name1) ?></td>
                    <td><?= h($person->last_name2) ?></td>
                    <td><?= h($person->birth) ?></td>
                    <td><?= h($person->nationality) ?></td>
                    <td><?= h($person->created) ?></td>
                    <td><?= h($person->modified) ?></td>
                    <td><?= h($person->gendre) ?></td>
                    <td><?= h($person->tels) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $person->doc_type]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $person->doc_type]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $person->doc_type], ['confirm' => __('Are you sure you want to delete # {0}?', $person->doc_type)]) ?>
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
