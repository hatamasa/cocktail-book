<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('マスタ管理一覧') ?></li>
        <li><?= $this->Html->link(__('材料管理'), ['controller' => 'elements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('タグ管理'), ['controller' => 'tags', 'action' => 'index']) ?></li>
        <li><?= $this->Form->postLink(__('マスタキャッシュリロード'), ['controller' => 'caches', 'action' => '/caches/reloadMaster'], ['confirm' => __('マスタキャッシュをリロードしますか？')]) ?></li>
    </ul>
</nav>