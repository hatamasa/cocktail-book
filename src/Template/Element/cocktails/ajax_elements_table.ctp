<?php if(isset($elements_list_selected)):?>
<?php foreach ($elements_list_selected as $key => $value):?>
<input type="text" name="elements_id_selected[]" value="<?=$value['elements_id']?>" />
<input type="text" name="amount_selected[]" value="<?=$value['amount']?>" />
<tr>
	<th><?=$key+1 ?></th>
	<td>(<?=$category_list[$value['category_kbn']]?>) <?=$value['name']?></td>
	<td><?=$value['amount']?></td>
</tr>
<?php endforeach;?>
<?php endif;?>