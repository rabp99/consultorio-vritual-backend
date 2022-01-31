<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Medicine $medicine
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Medicine'), ['action' => 'edit', $medicine->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Medicine'), ['action' => 'delete', $medicine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $medicine->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Medicines'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Medicine'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="medicines view content">
            <h3><?= h($medicine->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($medicine->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Presentation') ?></th>
                    <td><?= h($medicine->presentation) ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($medicine->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($medicine->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($medicine->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($medicine->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Recipe Details') ?></h4>
                <?php if (!empty($medicine->recipe_details)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Recipe Id') ?></th>
                            <th><?= __('Medicine Id') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Days') ?></th>
                            <th><?= __('Prescription') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($medicine->recipe_details as $recipeDetails) : ?>
                        <tr>
                            <td><?= h($recipeDetails->id) ?></td>
                            <td><?= h($recipeDetails->recipe_id) ?></td>
                            <td><?= h($recipeDetails->medicine_id) ?></td>
                            <td><?= h($recipeDetails->amount) ?></td>
                            <td><?= h($recipeDetails->days) ?></td>
                            <td><?= h($recipeDetails->prescription) ?></td>
                            <td><?= h($recipeDetails->created) ?></td>
                            <td><?= h($recipeDetails->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'RecipeDetails', 'action' => 'view', $recipeDetails->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'RecipeDetails', 'action' => 'edit', $recipeDetails->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'RecipeDetails', 'action' => 'delete', $recipeDetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $recipeDetails->id)]) ?>
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
