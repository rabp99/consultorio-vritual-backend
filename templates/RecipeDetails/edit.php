<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RecipeDetail $recipeDetail
 * @var string[]|\Cake\Collection\CollectionInterface $recipes
 * @var string[]|\Cake\Collection\CollectionInterface $medicines
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $recipeDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $recipeDetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Recipe Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="recipeDetails form content">
            <?= $this->Form->create($recipeDetail) ?>
            <fieldset>
                <legend><?= __('Edit Recipe Detail') ?></legend>
                <?php
                    echo $this->Form->control('recipe_id', ['options' => $recipes]);
                    echo $this->Form->control('medicine_id', ['options' => $medicines]);
                    echo $this->Form->control('amount');
                    echo $this->Form->control('days');
                    echo $this->Form->control('prescription');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
