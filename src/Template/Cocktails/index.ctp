<!-- 検索フォーム -->
<div class="title__wrapper">
    <h1>カクテルを検索する</h1>
</div>
<div class="cocktailSearch__wrapper">
    <form action="<?= $this->Url->build('/cocktails/search') ?>" method="get">
        <?= $this->element('Cocktails/cocktail_conditions');?>
        <button type="submit" class="btn btn-default btn-full" >検索</button>
    </form>
</div>