<a href="<?= $this->Url->build('/cocktails/') ?><?= $row['id']?>">
<ul>
    <li><h3><?= $row['name']?></h3></li>
    <li>グラス：<?= $glass_list[$row['glass']]?></li>
    <li>強さ： <?= $percentage_list[$row['percentage']]?></li>
    <li>色： <?= $row['color']?></li>
    <li>味： <?= $taste_list[$row['taste']]?></li>
</ul>
</a>