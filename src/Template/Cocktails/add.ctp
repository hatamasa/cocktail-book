<script type="text/javascript" src="/js/cocktails/cocktail_input_area.js"></script>
<!-- フォーム -->
<div class="title__wrapper">
    <h1>カクテルを作成する</h1>
</div>
<div class="createCocktail__wrapper">
    <form action="<?= $this->Url->build('/admin/cocktails/add') ?>" class="cocktail-form" method="post">
        <?= $this->element('Admin/Cocktails/cocktail_input_area');?>
        <button type="submit" class="btn btn-default btn-full cancel" >保存する</button>
    </form>
</div>
