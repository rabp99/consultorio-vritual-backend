<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LaboratoryExam $laboratoryExam
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Laboratory Exam'), ['action' => 'edit', $laboratoryExam->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Laboratory Exam'), ['action' => 'delete', $laboratoryExam->id], ['confirm' => __('Are you sure you want to delete # {0}?', $laboratoryExam->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Laboratory Exams'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Laboratory Exam'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="laboratoryExams view content">
            <h3><?= h($laboratoryExam->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($laboratoryExam->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($laboratoryExam->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($laboratoryExam->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($laboratoryExam->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($laboratoryExam->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Appointments') ?></h4>
                <?php if (!empty($laboratoryExam->appointments)) : ?>
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
                            <th><?= __('Cancel Date') ?></th>
                            <th><?= __('Cost') ?></th>
                            <th><?= __('Systolic Blood Pressure') ?></th>
                            <th><?= __('Diastolic Blood Pressure') ?></th>
                            <th><?= __('Weight') ?></th>
                            <th><?= __('Height') ?></th>
                            <th><?= __('Comment') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('State') ?></th>
                            <th><?= __('User Created') ?></th>
                            <th><?= __('User Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($laboratoryExam->appointments as $appointments) : ?>
                        <tr>
                            <td><?= h($appointments->id) ?></td>
                            <td><?= h($appointments->patient_person_doc_type) ?></td>
                            <td><?= h($appointments->patient_person_doc_num) ?></td>
                            <td><?= h($appointments->employee_person_doc_type) ?></td>
                            <td><?= h($appointments->employee_person_doc_num) ?></td>
                            <td><?= h($appointments->consulting_room_id) ?></td>
                            <td><?= h($appointments->appointment_date) ?></td>
                            <td><?= h($appointments->cancel_date) ?></td>
                            <td><?= h($appointments->cost) ?></td>
                            <td><?= h($appointments->systolic_blood_pressure) ?></td>
                            <td><?= h($appointments->diastolic_blood_pressure) ?></td>
                            <td><?= h($appointments->weight) ?></td>
                            <td><?= h($appointments->height) ?></td>
                            <td><?= h($appointments->comment) ?></td>
                            <td><?= h($appointments->created) ?></td>
                            <td><?= h($appointments->modified) ?></td>
                            <td><?= h($appointments->state) ?></td>
                            <td><?= h($appointments->user_created) ?></td>
                            <td><?= h($appointments->user_modified) ?></td>
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
