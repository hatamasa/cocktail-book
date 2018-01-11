<?php foreach ($element_list as $element):?>
	<option value="<?=$element['id']?>" <?php if (isset($params['element']) && $params['element'] == $element['id']):?>selected<?php endif;?> ><?=$element['name']?></option>
<?php endforeach;?>