<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Element $element
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Element'), ['action' => 'edit', $element->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Element'), ['action' => 'delete', $element->id], ['confirm' => __('Are you sure you want to delete # {0}?', $element->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Elements'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Element'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cocktails'), ['controller' => 'Cocktails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cocktail'), ['controller' => 'Cocktails', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="elements view large-9 medium-8 columns content">
    <h3><?= h($element->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category Kbn') ?></th>
            <td><?= h($element->category_kbn) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($element->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($element->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dt Create') ?></th>
            <td><?= h($element->dt_create) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Cocktails') ?></h4>
        <?php if (!empty($element->cocktails)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Search Name') ?></th>
                <th scope="col"><?= __('Glass') ?></th>
                <th scope="col"><?= __('Percentage') ?></th>
                <th scope="col"><?= __('Color') ?></th>
                <th scope="col"><?= __('Taste') ?></th>
                <th scope="col"><?= __('Processes') ?></th>
                <th scope="col"><?= __('Dt Create') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($element->cocktails as $cocktails): ?>
            <tr>
                <td><?= h($cocktails->id) ?></td>
                <td><?= h($cocktails->name) ?></td>
                <td><?= h($cocktails->search_name) ?></td>
                <td><?= h($cocktails->glass) ?></td>
                <td><?= h($cocktails->percentage) ?></td>
                <td><?= h($cocktails->color) ?></td>
                <td><?= h($cocktails->taste) ?></td>
                <td><?= h($cocktails->processes) ?></td>
                <td><?= h($cocktails->dt_create) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Cocktails', 'action' => 'view', $cocktails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Cocktails', 'action' => 'edit', $cocktails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Cocktails', 'action' => 'delete', $cocktails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cocktails->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
