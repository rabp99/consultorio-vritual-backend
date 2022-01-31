<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Diagnostic $diagnostic
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Diagnostic'), ['action' => 'edit', $diagnostic->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Diagnostic'), ['action' => 'delete', $diagnostic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diagnostic->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Diagnostics'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Diagnostic'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="diagnostics view content">
            <h3><?= h($diagnostic->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Appointment') ?></th>
                    <td><?= $diagnostic->has('appointment') ? $this->Html->link($diagnostic->appointment->id, ['controller' => 'Appointments', 'action' => 'view', $diagnostic->appointment->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Disease') ?></th>
                    <td><?= $diagnostic->has('disease') ? $this->Html->link($diagnostic->disease->id, ['controller' => 'Diseases', 'action' => 'view', $diagnostic->disease->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($diagnostic->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($diagnostic->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($diagnostic->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($diagnostic->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
