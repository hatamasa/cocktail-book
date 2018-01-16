<?php foreach ($elements_list as $elements):?>
	<option value="<?=$elements['id']?>" <?php if ($params['elements']??'' == $elements['id']):?>selected<?php endif;?> ><?=$elements['name']?></option>
<?php endforeach;?>