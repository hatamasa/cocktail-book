<div>
<a href="<?= $this->Url->build('/cocktails/view/') ?><?= $row['id']?>">
    <span class='cocktail-card'>
        <span class="card-title"><?= $row['name']?></span>
        <span class="card-content">
            <img src="<?=$row['img_url']??$no_img_url ?>">
            <table class="card-table">
                <tr><th>グラス</th><td><?= $glass_list[$row['glass']]?></td></tr>
                <tr><th>味 強さ</th><td><?= $taste_list[$row['taste']]?> <?= $percentage_list[$row['percentage']]?></td></tr>
                <tr><th>色</th><td><?= $row['color']?></td></tr>
                <tr><th>タグ</th>
                <td>
                <?php foreach ($row['tags'] as $tag): ?>
                   <?= $tag['name'] ?>
                <?php endforeach;?>
                </td></tr>
            </table>
        </span>
    </span>
</a>
</div>