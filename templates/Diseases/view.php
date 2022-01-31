<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Disease $disease
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Disease'), ['action' => 'edit', $disease->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Disease'), ['action' => 'delete', $disease->id], ['confirm' => __('Are you sure you want to delete # {0}?', $disease->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Diseases'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Disease'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="diseases view content">
            <h3><?= h($disease->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($disease->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($disease->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($disease->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($disease->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($disease->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Diagnostics') ?></h4>
                <?php if (!empty($disease->diagnostics)) : ?>
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
                        <?php foreach ($disease->diagnostics as $diagnostics) : ?>
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
        </div>
    </div>
</div>
