<!-- 検索結果表示 -->
<?php if(isset($cocktail)): ?>
<div class="col-label-1"><?= $cocktail['name']?></div>
<table>
	<tr>
		<th>グラス</th>
		<td><?= $glass_list[$cocktail['glass']]?></td>
	</tr>
	<tr>
		<th>度数</th>
		<td><?= $percentage_list[$cocktail['percentage']]?></td>
	</tr>
	<tr>
		<th>色</th>
		<td><?= $cocktail['color']?></td>
	</tr>
	<tr>
		<th>味</th>
		<td><?= $taste_list[$cocktail['taste']]?></td>
	</tr>
</table>
<div class="col-label-1">入れるもの</div>
<table>
	<?php foreach ($elements as $element): ?>
    	<tr>
		<th><?= $category_list[$element['category_kbn']]?></th>
		<td><?= $element['name']?></td>
		<td><?= $element['amount']?></td>
	</tr>
    <?php endforeach; ?>
</table>
<div class="col-label-1">手順</div>
<div><?= $cocktail['processes']?></div>
<?php endif;?>