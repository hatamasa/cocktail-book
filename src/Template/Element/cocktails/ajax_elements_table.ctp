<?php if(isset($elements_list_selected)):?>
<?php foreach ($elements_list_selected as $key => $value):?>
<tr>
	<input type="hidden" class="elements_id_selected" name="elements_id_selected[]" value="<?=$value['id']?>" />
	<input type="hidden" class="amount_selected" name="amount_selected[]" value="<?=$value['amount']?>" />
	<th><?=$key+1 ?></th>
	<td>(<?=$category_list[$value['category_kbn']]?>) <?=$value['name']?></td>
	<td><?=$value['amount']?></td>
</tr>
<?php endforeach;?>
<?php endif;?>