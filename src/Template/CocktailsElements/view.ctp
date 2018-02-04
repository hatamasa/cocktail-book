<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CocktailsElement $cocktailsElement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cocktails Element'), ['action' => 'edit', $cocktailsElement->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cocktails Element'), ['action' => 'delete', $cocktailsElement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cocktailsElement->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cocktails Elements'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cocktails Element'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cocktails'), ['controller' => 'Cocktails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cocktail'), ['controller' => 'Cocktails', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Elements'), ['controller' => 'Elements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Element'), ['controller' => 'Elements', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cocktailsElements view large-9 medium-8 columns content">
    <h3><?= h($cocktailsElement->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Cocktail') ?></th>
            <td><?= $cocktailsElement->has('cocktail') ? $this->Html->link($cocktailsElement->cocktail->name, ['controller' => 'Cocktails', 'action' => 'view', $cocktailsElement->cocktail->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Element') ?></th>
            <td><?= $cocktailsElement->has('element') ? $this->Html->link($cocktailsElement->element->name, ['controller' => 'Elements', 'action' => 'view', $cocktailsElement->element->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= h($cocktailsElement->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cocktailsElement->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dt Create') ?></th>
            <td><?= h($cocktailsElement->dt_create) ?></td>
        </tr>
    </table>
</div>
