<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment[]|\Cake\Collection\CollectionInterface $appointments
 */
?>
<div class="appointments index content">
    <?= $this->Html->link(__('New Appointment'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Appointments') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('patient_person_doc_type') ?></th>
                    <th><?= $this->Paginator->sort('patient_person_doc_num') ?></th>
                    <th><?= $this->Paginator->sort('employee_person_doc_type') ?></th>
                    <th><?= $this->Paginator->sort('employee_person_doc_num') ?></th>
                    <th><?= $this->Paginator->sort('consulting_room_id') ?></th>
                    <th><?= $this->Paginator->sort('appointment_date') ?></th>
                    <th><?= $this->Paginator->sort('cost') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?= $this->Number->format($appointment->id) ?></td>
                    <td><?= h($appointment->patient_person_doc_type) ?></td>
                    <td><?= h($appointment->patient_person_doc_num) ?></td>
                    <td><?= h($appointment->employee_person_doc_type) ?></td>
                    <td><?= h($appointment->employee_person_doc_num) ?></td>
                    <td><?= $appointment->has('consulting_room') ? $this->Html->link($appointment->consulting_room->id, ['controller' => 'ConsultingRooms', 'action' => 'view', $appointment->consulting_room->id]) : '' ?></td>
                    <td><?= h($appointment->appointment_date) ?></td>
                    <td><?= $this->Number->format($appointment->cost) ?></td>
                    <td><?= h($appointment->created) ?></td>
                    <td><?= h($appointment->modified) ?></td>
                    <td><?= h($appointment->state) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $appointment->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $appointment->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $appointment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointment->id)]) ?>
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
