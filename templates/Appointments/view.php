<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Appointment'), ['action' => 'edit', $appointment->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Appointment'), ['action' => 'delete', $appointment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appointment->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Appointments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Appointment'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="appointments view content">
            <h3><?= h($appointment->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Patient Person Doc Type') ?></th>
                    <td><?= h($appointment->patient_person_doc_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Patient Person Doc Num') ?></th>
                    <td><?= h($appointment->patient_person_doc_num) ?></td>
                </tr>
                <tr>
                    <th><?= __('Employee Person Doc Type') ?></th>
                    <td><?= h($appointment->employee_person_doc_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Employee Person Doc Num') ?></th>
                    <td><?= h($appointment->employee_person_doc_num) ?></td>
                </tr>
                <tr>
                    <th><?= __('Consulting Room') ?></th>
                    <td><?= $appointment->has('consulting_room') ? $this->Html->link($appointment->consulting_room->id, ['controller' => 'ConsultingRooms', 'action' => 'view', $appointment->consulting_room->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($appointment->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($appointment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cost') ?></th>
                    <td><?= $this->Number->format($appointment->cost) ?></td>
                </tr>
                <tr>
                    <th><?= __('Appointment Date') ?></th>
                    <td><?= h($appointment->appointment_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($appointment->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($appointment->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Diagnostics') ?></h4>
                <?php if (!empty($appointment->diagnostics)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Appointment Id') ?></th>
                            <th><?= __('Disease Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('State') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($appointment->diagnostics as $diagnostics) : ?>
                        <tr>
                            <td><?= h($diagnostics->id) ?></td>
                            <td><?= h($diagnostics->appointment_id) ?></td>
                            <td><?= h($diagnostics->disease_id) ?></td>
                            <td><?= h($diagnostics->created) ?></td>
                            <td><?= h($diagnostics->modified) ?></td>
                            <td><?= h($diagnostics->state) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Diagnostics', 'action' => 'view', $diagnostics->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Diagnostics', 'action' => 'edit', $diagnostics->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Diagnostics', 'action' => 'delete', $diagnostics->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diagnostics->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Recipes') ?></h4>
                <?php if (!empty($appointment->recipes)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Appointment Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('State') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($appointment->recipes as $recipes) : ?>
                        <tr>
                            <td><?= h($recipes->id) ?></td>
                            <td><?= h($recipes->appointment_id) ?></td>
                            <td><?= h($recipes->created) ?></td>
                            <td><?= h($recipes->modified) ?></td>
                            <td><?= h($recipes->state) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Recipes', 'action' => 'view', $recipes->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Recipes', 'action' => 'edit', $recipes->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Recipes', 'action' => 'delete', $recipes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $recipes->id)]) ?>
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
