<script type="text/javascript" src="/js/cocktails/cocktail_input_area.js"></script>
<!-- フォーム -->
<div class="title__wrapper">
    <h1>カクテルを編集する</h1>
</div>
<div class="createCocktail__wrapper">
    <?= $this->Form->create($params, ['type' => 'file', 'url' => "/cocktails/edit/" . $params['id'], 'class' => 'cocktail-form']); ?>
        <?= $this->element('Cocktails/cocktail_input_area');?>
        <button type="submit" class="btn btn-default btn-full cancel" >保存する</button>
    <?= $this->Form->end() ?>
</div>
