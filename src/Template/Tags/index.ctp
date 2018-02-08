<?= $this->element('_admin_nav');?>
<div class="tags index large-9 medium-8 columns content">
    <h3><?= __('タグ管理') ?></h3>
    <?= $this->Html->link(__('タグを作成する'), ['action' => 'add']) ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dt_create') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tags as $tag): ?>
            <tr>
                <td><?= $this->Number->format($tag->id) ?></td>
                <td><?= h($tag->name) ?></td>
                <td><?= h($tag->dt_create) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $tag->id]) ?>
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $tag->id], ['confirm' => __('このタグを削除しますか？ # {0}', $tag->id)]) ?>

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
