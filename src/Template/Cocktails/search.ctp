<div class="title__wrapper">
    <h1>検索結果</h1>
</div>
<h2>検索条件</h2>
<!-- TODO 条件変更リンク -->
<!-- TODO 左寄せ表示 -->
<table>
    <?php if(isset($params['name']) && !empty($params['name'])):?>
    <tr><th>カクテルの名前</th>
        <td>「<?= $params['name'] ?>」</td>
    </tr>
    <?php endif;?>
    <?php if(isset($params['glass'])):?>
    <tr><th>グラスタイプ</th>
        <td>
        <?php foreach ($params['glass'] as $glass):?>
            <div><?= $glass_list[$glass]?></div>
        <?php endforeach;?>
        </td>
    </tr>
    <?php endif;?>
    <?php if(isset($params['percentage'])):?>
    <tr><th>強さ</th>
        <td>
        <?php foreach ($params['percentage'] as $percentage):?>
            <div><?= $percentage_list[$percentage]?></div>
        <?php endforeach;?>
        </td>
    </tr>
    <?php endif;?>
    <?php if(isset($params['taste'])):?>
    <tr><th>テイスト</th>
        <td>
        <?php foreach ($params['taste'] as $taste):?>
            <div><?= $taste_list[$taste]?></div>
        <?php endforeach;?>
        </td>
    </tr>
    <?php endif;?>
    <?php if(isset($params['tag_id'])):?>
    <tr><th>タグ</th>
        <td>
        <?php foreach ($params['tag_id'] as $key => $value):?>
            <div><?= $tags_master[$key]['name']?></div>
        <?php endforeach;?>
        </td>
    </tr>
    <?php endif;?>
</table>
<!-- 検索結果表示 -->
<div class="results__wrapper">
<?php if(isset($results)):?>
    <?php foreach ($results as $row): ?>
    <?= $this->element('Cocktails/cocktail', ['row' => $row]);?>
    <?php endforeach; ?>
<?php endif;?>
</div>