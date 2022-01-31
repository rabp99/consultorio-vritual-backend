<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RecipeDetail[]|\Cake\Collection\CollectionInterface $recipeDetails
 */
?>
<div class="recipeDetails index content">
    <?= $this->Html->link(__('New Recipe Detail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Recipe Details') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('recipe_id') ?></th>
                    <th><?= $this->Paginator->sort('medicine_id') ?></th>
                    <th><?= $this->Paginator->sort('amount') ?></th>
                    <th><?= $this->Paginator->sort('days') ?></th>
                    <th><?= $this->Paginator->sort('prescription') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recipeDetails as $recipeDetail): ?>
                <tr>
                    <td><?= $this->Number->format($recipeDetail->id) ?></td>
                    <td><?= $recipeDetail->has('recipe') ? $this->Html->link($recipeDetail->recipe->id, ['controller' => 'Recipes', 'action' => 'view', $recipeDetail->recipe->id]) : '' ?></td>
                    <td><?= $recipeDetail->has('medicine') ? $this->Html->link($recipeDetail->medicine->id, ['controller' => 'Medicines', 'action' => 'view', $recipeDetail->medicine->id]) : '' ?></td>
                    <td><?= $this->Number->format($recipeDetail->amount) ?></td>
                    <td><?= $this->Number->format($recipeDetail->days) ?></td>
                    <td><?= h($recipeDetail->prescription) ?></td>
                    <td><?= h($recipeDetail->created) ?></td>
                    <td><?= h($recipeDetail->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $recipeDetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $recipeDetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $recipeDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $recipeDetail->id)]) ?>
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
