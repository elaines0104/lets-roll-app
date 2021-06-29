<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriesPlace $categoriesPlace
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $categoriesPlace->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $categoriesPlace->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Categories Places'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Places'), ['controller' => 'Places', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Place'), ['controller' => 'Places', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="categoriesPlaces form large-9 medium-8 columns content">
    <?= $this->Form->create($categoriesPlace) ?>
    <fieldset>
        <legend><?= __('Edit Categories Place') ?></legend>
        <?php
            echo $this->Form->control('category_id', ['options' => $categories]);
            echo $this->Form->control('place_id', ['options' => $places]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
