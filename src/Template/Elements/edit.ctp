<?php
use Cake\Core\Configure;
?>
<?= $this->element('_admin_nav');?>
<div class="elements form large-9 medium-8 columns content">
    <?= $this->Form->create($element) ?>
    <fieldset>
        <legend><?= __('材料を編集する') ?></legend>
        <?php
            echo $this->Form->input('category_kbn',[
                "type"=>"select",
                "options"=>Configure::read('category_kbn'),
            ]);
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('保存')) ?>
    <?= $this->Form->end() ?>
</div>
