<script type="text/javascript" src="/js/cocktails/cocktail_input_area.js"></script>
<!-- フォーム -->
<div class="title__wrapper">
    <h1>カクテルを編集する</h1>
</div>
<div class="createCocktail__wrapper">
    <form action="/cocktails/edit/<?= $params['id'] ?>" class="cocktail-form" method="post">
        <input type="hidden" name="_method" value="PUT">
        <?= $this->element('Cocktails/cocktail_input_area');?>
        <button type="submit" class="btn btn-default btn-full cancel" >保存する</button>
    </form>
</div>
