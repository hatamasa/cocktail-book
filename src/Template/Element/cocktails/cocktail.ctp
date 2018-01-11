<ul class="cocktail_block">
	<li class="cocktail_name">
		<a href="<?= $this->Url->build('/cocktails/') ?><?= $results['id']?>"><?= $results['name']?></a>
	</li>
	<li>グラス：<?= $glass_list[$results['glass']]?></li>
	<li>強さ： <?= $percentage_list[$results['percentage']]?></li>
	<li>色： <?= $results['color']?></li>
	<li>味： <?= $taste_list[$results['taste']]?></li>
</ul>