<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriesPlace $categoriesPlace
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Categories Place'), ['action' => 'edit', $categoriesPlace->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Categories Place'), ['action' => 'delete', $categoriesPlace->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categoriesPlace->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Categories Places'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Categories Place'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Places'), ['controller' => 'Places', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Place'), ['controller' => 'Places', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categoriesPlaces view large-9 medium-8 columns content">
    <h3><?= h($categoriesPlace->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $categoriesPlace->has('category') ? $this->Html->link($categoriesPlace->category->name, ['controller' => 'Categories', 'action' => 'view', $categoriesPlace->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Place') ?></th>
            <td><?= $categoriesPlace->has('place') ? $this->Html->link($categoriesPlace->place->name, ['controller' => 'Places', 'action' => 'view', $categoriesPlace->place->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($categoriesPlace->id) ?></td>
        </tr>
    </table>
</div>
