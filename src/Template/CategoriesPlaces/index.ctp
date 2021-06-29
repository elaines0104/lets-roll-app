<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriesPlace[]|\Cake\Collection\CollectionInterface $categoriesPlaces
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Categories Place'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Places'), ['controller' => 'Places', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Place'), ['controller' => 'Places', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="categoriesPlaces index large-9 medium-8 columns content">
    <h3><?= __('Categories Places') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('place_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categoriesPlaces as $categoriesPlace): ?>
            <tr>
                <td><?= $this->Number->format($categoriesPlace->id) ?></td>
                <td><?= $categoriesPlace->has('category') ? $this->Html->link($categoriesPlace->category->name, ['controller' => 'Categories', 'action' => 'view', $categoriesPlace->category->id]) : '' ?></td>
                <td><?= $categoriesPlace->has('place') ? $this->Html->link($categoriesPlace->place->name, ['controller' => 'Places', 'action' => 'view', $categoriesPlace->place->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $categoriesPlace->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $categoriesPlace->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $categoriesPlace->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categoriesPlace->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
