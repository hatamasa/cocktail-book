<!-- 検索結果表示 -->
<div class="title__wrapper">
    <h1><?= $cocktail['name']?></h1>
    <ul>
        <li>
            <a href="/cocktails/<?=$cocktail['id']?>/edit">編集する</a>
        </li>
    </ul>
</div>
<div class="cocktail__wrapper">
    <table class="detail-table">
        <tr>
            <th>グラスタイプ</th>
            <td><?= $glass_list[$cocktail['glass']]?></td>
        </tr>
        <tr>
            <th>強さ</th>
            <td><?= $percentage_list[$cocktail['percentage']]?></td>
        </tr>
        <tr>
            <th>色</th>
            <td><?= $cocktail['color']?></td>
        </tr>
        <tr>
            <th>テイスト</th>
            <td><?= $taste_list[$cocktail['taste']]?></td>
        </tr>
    </table>
</div>
<div class="cocktailElements__wrapper">
    <h2>入れるもの</h2>
    <table class="detail-elements-table">
    <?php foreach ($cocktail_elements as $element): ?>
        <tr>
            <th><?= $category_list[$element['category_kbn']]?></th>
            <td><?= $element['name']?></td>
            <td><?= $element['amount']?></td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>
<div class="cocktail__wrapper">
    <h2>手順</h2>
    <p><?= $cocktail['processes']?></p>
</div>

