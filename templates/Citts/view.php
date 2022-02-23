<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Citt $citt
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Citt'), ['action' => 'edit', $citt->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Citt'), ['action' => 'delete', $citt->id], ['confirm' => __('Are you sure you want to delete # {0}?', $citt->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Citts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Citt'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="citts view content">
            <h3><?= h($citt->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Appointment') ?></th>
                    <td><?= $citt->has('appointment') ? $this->Html->link($citt->appointment->appointment_date, ['controller' => 'Appointments', 'action' => 'view', $citt->appointment->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Number Days') ?></th>
                    <td><?= h($citt->number_days) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($citt->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Date') ?></th>
                    <td><?= h($citt->start_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Date') ?></th>
                    <td><?= h($citt->end_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($citt->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($citt->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
