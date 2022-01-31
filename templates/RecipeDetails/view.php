<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RecipeDetail $recipeDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Recipe Detail'), ['action' => 'edit', $recipeDetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Recipe Detail'), ['action' => 'delete', $recipeDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $recipeDetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Recipe Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Recipe Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="recipeDetails view content">
            <h3><?= h($recipeDetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Recipe') ?></th>
                    <td><?= $recipeDetail->has('recipe') ? $this->Html->link($recipeDetail->recipe->id, ['controller' => 'Recipes', 'action' => 'view', $recipeDetail->recipe->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Medicine') ?></th>
                    <td><?= $recipeDetail->has('medicine') ? $this->Html->link($recipeDetail->medicine->id, ['controller' => 'Medicines', 'action' => 'view', $recipeDetail->medicine->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Prescription') ?></th>
                    <td><?= h($recipeDetail->prescription) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($recipeDetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($recipeDetail->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Days') ?></th>
                    <td><?= $this->Number->format($recipeDetail->days) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($recipeDetail->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($recipeDetail->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
