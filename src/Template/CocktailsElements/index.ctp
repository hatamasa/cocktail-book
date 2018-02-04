<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CocktailsElement[]|\Cake\Collection\CollectionInterface $cocktailsElements
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cocktails Element'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cocktails'), ['controller' => 'Cocktails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cocktail'), ['controller' => 'Cocktails', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Elements'), ['controller' => 'Elements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Element'), ['controller' => 'Elements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cocktailsElements index large-9 medium-8 columns content">
    <h3><?= __('Cocktails Elements') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cocktail_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('element_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dt_create') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cocktailsElements as $cocktailsElement): ?>
            <tr>
                <td><?= $this->Number->format($cocktailsElement->id) ?></td>
                <td><?= $cocktailsElement->has('cocktail') ? $this->Html->link($cocktailsElement->cocktail->name, ['controller' => 'Cocktails', 'action' => 'view', $cocktailsElement->cocktail->id]) : '' ?></td>
                <td><?= $cocktailsElement->has('element') ? $this->Html->link($cocktailsElement->element->name, ['controller' => 'Elements', 'action' => 'view', $cocktailsElement->element->id]) : '' ?></td>
                <td><?= h($cocktailsElement->amount) ?></td>
                <td><?= h($cocktailsElement->dt_create) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cocktailsElement->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cocktailsElement->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cocktailsElement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cocktailsElement->id)]) ?>
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
