<?php foreach ($elements_list as $elements):?>
	<option value="<?=$elements['id']?>" <?php if (isset($params['elements']) && $params['elements'] == $elements['id']):?>selected<?php endif;?> ><?=$elements['name']?></option>
<?php endforeach;?>