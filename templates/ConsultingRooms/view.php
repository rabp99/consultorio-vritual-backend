<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConsultingRoom $consultingRoom
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Consulting Room'), ['action' => 'edit', $consultingRoom->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Consulting Room'), ['action' => 'delete', $consultingRoom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $consultingRoom->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Consulting Rooms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Consulting Room'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="consultingRooms view content">
            <h3><?= h($consultingRoom->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($consultingRoom->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Floor') ?></th>
                    <td><?= h($consultingRoom->floor) ?></td>
                </tr>
                <tr>
                    <th><?= __('Place') ?></th>
                    <td><?= $consultingRoom->has('place') ? $this->Html->link($consultingRoom->place->id, ['controller' => 'Places', 'action' => 'view', $consultingRoom->place->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($consultingRoom->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($consultingRoom->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($consultingRoom->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($consultingRoom->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Appointments') ?></h4>
                <?php if (!empty($consultingRoom->appointments)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Patient Person Doc Type') ?></th>
                            <th><?= __('Patient Person Doc Num') ?></th>
                            <th><?= __('Employee Person Doc Type') ?></th>
                            <th><?= __('Employee Person Doc Num') ?></th>
                            <th><?= __('Consulting Room Id') ?></th>
                            <th><?= __('Appointment Date') ?></th>
                            <th><?= __('Cost') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('State') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($consultingRoom->appointments as $appointments) : ?>
                        <tr>
                            <td><?= h($appointments->id) ?></td>
                            <td><?= h($appointments->patient_person_doc_type) ?></td>
                            <td><?= h($appointments->patient_person_doc_num) ?></td>
                            <td><?= h($appointments->employee_person_doc_type) ?></td>
                            <td><?= h($appointments->employee_person_doc_num) ?></td>
                            <td><?= h($appointments->consulting_room_id) ?></td>
                            <td><?= h($appointments->appointment_date) ?></td>
                            <td><?= h($appointments->cost) ?></td>
                            <td><?= h($appointments->created) ?></td>
                            <td><?= h($appointments->modified) ?></td>
                            <td><?= h($appointments->state) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Appointments', 'action' => 'view', $appointments->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Appointments', 'action' => 'edit', $appointments->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Appointments', 'action' => 'delete', $appointments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointments->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
