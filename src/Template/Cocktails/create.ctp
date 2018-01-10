<?php
echo $this->element('cocktails/common');
?>

<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
<script>
$('#category1-select').bind("change keyup", function() {
    var id = $("#category1-select").val();
    $("#elements1_select").load( "./getElementsOptions/"+id);
});

</script>
<!-- フォーム -->
<form action="<?= $this->Url->build('/cocktails/create') ?>" method="post">
	<h3>カクテルを作成する</h3>
	<div class="cocktail__block">
		<div class="form-group">
			<div class="col-label-2">名前</div>
			<div class="col-input-2">
				<input type="text" name="name" id="input-text-1" value="<?php if(isset($params['name'])): ?><?= $params['name'] ?><?php endif;?>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-label-2">グラス</div>
			<div class="col-input-2">
			<?php foreach ($glass_list as $key => $value):?>
				<input type="radio" name="glass" value="<?= $key?>"
				<?php if(isset($params['glass']) && $params['glass'] == $key): ?>checked="checked"<?php endif; ?> /><?= $value?>
			<?php endforeach; ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-label-2">強さ</div>
			<div class="col-input-2">
			<?php foreach ($percentage_list as $key => $value):?>
				<input type="radio" name="percentage" value="<?= $key?>"
				<?php if(isset($params['percentage']) && $params['percentage'] == $key): ?>checked="checked"<?php endif; ?> /><?= $value?>
			<?php endforeach; ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-label-2">色</div>
			<div class="col-input-2">
				<input type="text" name="color" id="input-text-1" value="<?php if(isset($params['color'])): ?><?= $params['color']?><?php endif; ?>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-label-2">味</div>
			<div class="col-input-2">
			<?php foreach ($taste_list as $key => $value):?>
				<input type="radio" name="taste" value="<?= $key?>"
				<?php if(isset($params['taste']) && $params['taste'] == $key): ?>checked="checked"<?php endif; ?> /><?= $value?>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
	<h3>材料を選択する</h3>
	<div class="cocktail-element__block">
		<table class="element-table"><!--  TODO 可変と入力保持にしたい -->
			<tr>
				<th>カテゴリ</th>
				<td>
					<select name="category[]" id="category1_select">
					<?php foreach ($category_list as $key => $value):?>
						<option value="<?=$key?>" <?php if (isset($params['category'][0]) && $params['category'][0] == $key):?>selected<?php endif;?> ><?=$value?></option>
					<?php endforeach;?>
					</select>
				</td>
				<th>材料</th>
				<td>
					<select name="elements_id[]" id="elements1_select">
					<?php foreach ($elements_options as $elements):?>
						<option value="<?=$key?>" <?php if (isset($params['elements_id'][0]) && $params['elements_id'][0] == $elements['id']):?>selected<?php endif;?> ><?=$elements['name']?></option>
					<?php endforeach;?>
					</select>
				</td>
				<th>量</th>
				<td><input type="text" name="amount[]" value="<?php if(isset($params['amount'][0])): ?><?= $params['amount'][0]?><?php endif; ?>" /></td>
			</tr>
		</table>
	</div>
	<div class="cacktail-processes__block">
		<div class="form-group">
			<div class="col-label-2">作成手順</div>
			<div class="col-input-large">
				<textarea name="processes" cols="70" rows="5" ><?php if(isset($params['processes'])): ?><?= $params['processes']?><?php endif; ?></textarea>
			</div>
		</div>
	</div>
	<input type="submit" value="登録" />
</form>

<!-- 登録結果表示 -->
<?php if(isset($results)): ?>
<div class="results_col">
<?= $this->element('messages', ['messages' => $messages, 'errors' => $errors]);?>
     <ul class="cocktail_block">
        	<li class="cocktail_name"><a href="<?= $this->Url->build('/cocktails/') ?><?= $results['id']?>"><?= $results['name']?></a></li>
        	<li>グラス：<?= $glass_list[$results['glass']]?></li>
        	<li>強さ： <?= $percentage_list[$results['percentage']]?></li>
        	<li>色： <?= $results['color']?></li>
        	<li>味： <?= $taste_list[$results['taste']]?></li>
     </ul>
</div>
<?php endif;?>
