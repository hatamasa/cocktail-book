<?php foreach ($elements_list_selected as $key => $value):?>
<tr>
	<th><?=$key ?></th>
	<in><?=$value['name']?></td>
	<td><?=$value['amount']?></td>
</tr>
<?php endforeach;?>