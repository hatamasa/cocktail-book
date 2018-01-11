<?php if(isset($element_list_selected)):?>
<?php foreach ($element_list_selected as $key => $value):?>
<tr>
	<th><?=$key+1 ?></th>
	<td>(<?=$category_list[$value['category_kbn']]?>) <?=$value['name']?></td>
	<td><?=$value['amount']?></td>
</tr>
<?php endforeach;?>
<?php endif;?>