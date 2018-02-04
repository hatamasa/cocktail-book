<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CocktailsElement $cocktailsElement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cocktails Elements'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cocktails'), ['controller' => 'Cocktails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cocktail'), ['controller' => 'Cocktails', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Elements'), ['controller' => 'Elements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Element'), ['controller' => 'Elements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cocktailsElements form large-9 medium-8 columns content">
    <?= $this->Form->create($cocktailsElement) ?>
    <fieldset>
        <legend><?= __('Add Cocktails Element') ?></legend>
        <?php
            echo $this->Form->control('cocktail_id', ['options' => $cocktails]);
            echo $this->Form->control('element_id', ['options' => $elements]);
            echo $this->Form->control('amount');
            echo $this->Form->control('dt_create');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
