<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Place $place
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Place'), ['action' => 'edit', $place->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Place'), ['action' => 'delete', $place->id], ['confirm' => __('Are you sure you want to delete # {0}?', $place->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Places'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Place'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="places view content">
            <h3><?= h($place->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($place->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($place->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Latitude') ?></th>
                    <td><?= h($place->latitude) ?></td>
                </tr>
                <tr>
                    <th><?= __('Longitude') ?></th>
                    <td><?= h($place->longitude) ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($place->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($place->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($place->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($place->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Consulting Rooms') ?></h4>
                <?php if (!empty($place->consulting_rooms)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Floor') ?></th>
                            <th><?= __('Place Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('State') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($place->consulting_rooms as $consultingRooms) : ?>
                        <tr>
                            <td><?= h($consultingRooms->id) ?></td>
                            <td><?= h($consultingRooms->description) ?></td>
                            <td><?= h($consultingRooms->floor) ?></td>
                            <td><?= h($consultingRooms->place_id) ?></td>
                            <td><?= h($consultingRooms->created) ?></td>
                            <td><?= h($consultingRooms->modified) ?></td>
                            <td><?= h($consultingRooms->state) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ConsultingRooms', 'action' => 'view', $consultingRooms->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ConsultingRooms', 'action' => 'edit', $consultingRooms->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ConsultingRooms', 'action' => 'delete', $consultingRooms->id], ['confirm' => __('Are you sure you want to delete # {0}?', $consultingRooms->id)]) ?>
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
