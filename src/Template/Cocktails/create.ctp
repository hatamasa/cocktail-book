<?php
echo $this->element('cocktails/common');
?>

<!-- フォーム -->
<form action="<?= $this->Url->build('/cocktails/create') ?>" method="post">
	<div class="cocktailCreateForm__block">
		<div class="form-group">
			<div class="col-label-2">名前</div>
			<div class="col-input-2">
				<input type="text" name="name" value="<?php if(isset($params['name'])): ?><?= $params['name'] ?><?php endif;?>" />
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
				<input type="text" name="color" value="<?php if(isset($params['color'])): ?><?= $params['color']?><?php endif; ?>" />
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
		<table class="element-table"><!--  TODO 可変と入力保持にしたい -->
			<tr>
				<th>材料1</th>
				<td><input type="text" name="element_id[]" value="<?php if(isset($params['element_id'][0])): ?><?= $params['element_id'][0]?><?php endif; ?>" /></td>
				<th>量</th>
				<td><input type="text" name="amount[]" value="<?php if(isset($params['amount'][0])): ?><?= $params['amount'][0]?><?php endif; ?>" /></td>
			</tr>
			<tr>
				<th>材料2</th>
				<td><input type="text" name="element_id[]" value="<?php if(isset($params['element_id'][1])): ?><?= $params['element_id'][1]?><?php endif; ?>" /></td>
				<th>量</th>
				<td><input type="text" name="amount[]" value="<?php if(isset($params['amount'][1])): ?><?= $params['amount'][1]?><?php endif; ?>" /></td>
			</tr>
		</table>
		<div class="form-group">
			<div class="col-label-2">作成手順</div>
			<div class="col-input-large">
				<textarea name="processes" rows="4" cols="10"><?php if(isset($params['processes'])): ?><?= $params['processes']?><?php endif; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-label-2">author_id</div>
			<div class="col-input-2">
				<input type="text" name="author_id" value="<?php if(isset($params['author_id'])): ?><?= $params['author_id']?><?php endif; ?>" />
			</div>
		</div>
	</div>
	<input type="submit" value="登録" />
</form>
