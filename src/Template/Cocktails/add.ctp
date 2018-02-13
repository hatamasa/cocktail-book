<script type="text/javascript" src="/js/cocktails/cocktail_input_area.js"></script>
<!-- フォーム -->
<div class="title__wrapper">
    <h1>カクテルを作成する</h1>
</div>
<div class="createCocktail__wrapper">
    <?= $this->Form->create(null, ['type' => 'post', 'url' => "/cocktails/add", 'class' => 'cocktail-form']); ?>
        <?= $this->element('Cocktails/cocktail_input_area');?>
        <button type="submit" class="btn btn-default btn-full cancel" >保存する</button>
    <?= $this->Form->end() ?>
</div>
