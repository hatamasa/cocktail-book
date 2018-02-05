<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Elements'), ['controller' => 'elements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Tags'), ['controller' => 'tags', 'action' => 'index']) ?></li>
    </ul>
</nav>