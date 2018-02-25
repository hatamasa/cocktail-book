<div class="title__wrapper">
    <h1>カクテル一覧</h1>
</div>
<div class="display-flex sp-w100p mb-10">
    <h2 class="sp-disable  mr-10">現在の検索条件</h2>
    <button type="button" class="btn btn-default btn-full" data-toggle="modal" data-target="#sampleModal">検索条件変更</button>
</div>
<!-- モーダル・ダイアログ -->
<div class="modal fade" id="sampleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                <h4 class="modal-title">検索条件を変更する</h4>
            </div>
            <form action="<?= $this->Url->build('/cocktails/search') ?>" method="get">
                <div class="modal-body">
                    <?= $this->element('Cocktails/cocktail_conditions');?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-full" data-dismiss="modal">閉じる</button>
                    <button type="submit" class="btn btn-primary btn-full">この条件で再検索</button>
                </div>
            </form>
        </div>
    </div>
</div>


<table class="table-background-skeleton black-th groove-td sp-disable">
    <tr>
    <?php if(isset($params['name']) && !empty($params['name'])):?>
    <th>カクテルの名前</th>
        <td>「<?= $params['name'] ?>」に一致するカクテル</td>
    <?php endif;?>
    <?php if(isset($params['glass'])):?>
    <th>グラスタイプ</th>
        <td>
        <?php foreach ($params['glass'] as $glass):?>
            <div><?= $glass_list[$glass]?></div>
        <?php endforeach;?>
        </td>
    <?php endif;?>
    <?php if(isset($params['percentage'])):?>
    <th>強さ</th>
        <td>
        <?php foreach ($params['percentage'] as $percentage):?>
            <div><?= $percentage_list[$percentage]?></div>
        <?php endforeach;?>
        </td>
    <?php endif;?>
    <?php if(isset($params['taste'])):?>
    <th>テイスト</th>
        <td>
        <?php foreach ($params['taste'] as $taste):?>
            <div><?= $taste_list[$taste]?></div>
        <?php endforeach;?>
        </td>
    <?php endif;?>
    <?php if(isset($params['tag_id'])):?>
    </tr>
    <tr>
    <th>タグ</th>
        <td>
        <?php foreach ($params['tag_id'] as $tag_id):?>
            <?php foreach ($tags_master as $tag):?>
                <?php if($tag['id'] == $tag_id):?>
                    <div>#<?= $tag['name']?></div>
                <?php endif;?>
            <?php endforeach;?>
        <?php endforeach;?>
        </td>
    <?php endif;?>
    </tr>
</table>
<!-- 検索結果表示 -->
<?= $this->element('_paginator');?>
<div class="results__wrapper">
<?php if(isset($results)):?>
    <?php foreach ($results as $row): ?>
    <?= $this->element('Cocktails/cocktail', ['row' => $row]);?>
    <?php endforeach; ?>
<?php endif;?>
</div>
<?= $this->element('_paginator');?>