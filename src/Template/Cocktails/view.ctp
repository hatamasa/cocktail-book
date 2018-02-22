<!-- 検索結果表示 -->
<div class="title__wrapper">
    <h1><?= $cocktail['name']?></h1>
    <?php if ($auth->user()): ?>
    <ul>
        <li><?= $this->Html->link(__('編集する'), ['action' => 'edit', $cocktail['id']]) ?></li>
        <li><?= $this->Form->postLink(__('削除する'), ['action' => 'delete', $cocktail['id']], ['confirm' => __('このカクテルを削除しますか？')]) ?></li>
    </ul>
    <?php endif;?>
</div>
<!-- TODO 元画像を表示 -->
<div class="cocktail__wrapper">
    <img src="<?= $cocktail['img_url']??$no_img_url ?>"/>
    <table class="table-background-skeleton black-th groove-td">
        <tr>
            <th id="table-header-md">グラスタイプ</th>
            <td id="table-data-md"><?= $glass_list[$cocktail['glass']]?></td>
        </tr>
        <tr>
            <th id="table-header-md">強さ</th>
            <td id="table-data-md"><?= $percentage_list[$cocktail['percentage']]?></td>
        </tr>
        <tr>
            <th id="table-header-md">色</th>
            <td id="table-data-md"><?= $cocktail['color']?></td>
        </tr>
        <tr>
            <th id="table-header-md">テイスト</th>
            <td id="table-data-md"><?= $taste_list[$cocktail['taste']]?></td>
        </tr>
        <tr>
            <th id="table-header-md">タグ</th>
            <td>
            <?php foreach ($tags as $tag): ?>
                <div>#<?= $tag['name'] ?></div>
            <?php endforeach;?>
            </td>
        </tr>
    </table>
</div>
<div class="cocktailElements__wrapper">
    <h2>入れるもの</h2>
    <table class="table-background-skeleton black-th groove-td">
    <?php foreach ($cocktails_elements as $element): ?>
        <tr>
            <th id="table-header-md"><?= $category_list[$element['category_kbn']]?></th>
            <td id="table-data-md"><?= $element['name']?> ( <?= $element['amount']?> )</td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>
<div class="cocktail__wrapper">
    <h2>手順</h2>
    <p><?= $cocktail['processes']?></p>
</div>

