<a href="<?= $this->Url->build('/cocktails/view/') ?><?= $row['id']?>">
    <span class='cocktail-card'>
        <span class="card-title"><?= $row['name']?></span>
        <img src="<?=$row['img_url']??$no_img_url ?>">
        <ul>
            <li>グラス：<?= $glass_list[$row['glass']]?></li>
            <li>強さ： <?= $percentage_list[$row['percentage']]?></li>
            <li>色： <?= $row['color']?></li>
            <li>味： <?= $taste_list[$row['taste']]?></li>
        </ul>
    </span>
</a>
