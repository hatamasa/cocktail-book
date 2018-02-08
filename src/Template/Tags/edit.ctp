<?= $this->element('_admin_nav');?>
<div class="tags form large-9 medium-8 columns content">
    <?= $this->Form->create($tag) ?>
    <fieldset>
        <legend><?= __('タグを編集する') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('保存')) ?>
    <?= $this->Form->end() ?>
</div>
