<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Person'), ['action' => 'edit', $person->doc_type], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Person'), ['action' => 'delete', $person->doc_type], ['confirm' => __('Are you sure you want to delete # {0}?', $person->doc_type), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List People'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Person'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="people view content">
            <h3><?= h($person->doc_type) ?></h3>
            <table>
                <tr>
                    <th><?= __('Doc Type') ?></th>
                    <td><?= h($person->doc_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Doc Num') ?></th>
                    <td><?= h($person->doc_num) ?></td>
                </tr>
                <tr>
                    <th><?= __('Names') ?></th>
                    <td><?= h($person->names) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name1') ?></th>
                    <td><?= h($person->last_name1) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name2') ?></th>
                    <td><?= h($person->last_name2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nationality') ?></th>
                    <td><?= h($person->nationality) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gendre') ?></th>
                    <td><?= h($person->gendre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tels') ?></th>
                    <td><?= h($person->tels) ?></td>
                </tr>
                <tr>
                    <th><?= __('Birth') ?></th>
                    <td><?= h($person->birth) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($person->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($person->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
