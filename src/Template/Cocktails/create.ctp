<script>

$(function(){
	// selectボックスの変更イベント
    $('.category').on('change keyup', function() {
        var id = $('.category').val();
        $('.element').load( '/cocktails/getElementOptions/'+id);
    });

    // submitの押下イベント
    $('.submit-elements').on('click', function() {
        var obj = new Object();
        // 新しく追加する材料
        obj['category_kbn'] = $('.category').val();
        obj['elements_id'] = $('.element').val();
        obj['amount'] = $('.amount-input').val();

        // すでに追加されている材料をどう保持、取得するか。。。

        $('.element-table').load( '/cocktails/mergeElementTable/', obj);
    });

    // セレクトボックスを未選択状態にする
    $('.category').prop('selectedIndex', -1);

});

</script>
<!-- フォーム -->
<form action="<?= $this->Url->build('/cocktails/create') ?>" method="post">
	<h3>カクテルを作成する</h3>
	<div class="cocktail__block">
		<div class="form-group">
			<div class="col-label-2">名前</div>
			<div class="col-input-2">
				<input type="text" name="name" id="input-text-1" value="<?php if(isset($params['name'])){ echo $params['name'];} ?>" />
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
				<input type="text" name="color" id="input-text-1" value="<?php if(isset($params['color'])){ echo $params['color'];} ?>" />
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
        	<select class="category" name="category" size="5">
        	<?php foreach ($category_list as $key => $value):?>
        		<option value="<?=$key?>" <?php if (isset($params['category']) && $params['category'] == $key):?>selected<?php endif;?> ><?=$value?></option>
        	<?php endforeach;?>
        	</select>
        	<select class="element" name="element" size="5"><!-- Ajaxで生成 --></select>
		<input type="text" class="amount-input" name="amount" value="<?php if(isset($params['amount'][0])){ echo $params['amount'][0];} ?>" placeholder="量を入力..."/>
		<input type="button" class="submit-elements" value="材料を追加"/>
		<div class="submit-elements-label">材料一覧</div>
		<table class="element-table"><!-- Ajaxで生成 --></table>
	</div>
	<div class="cacktail-processes__block">
		<div class="form-group">
			<div class="col-label-2">作成手順</div>
			<div class="col-input-large">
				<textarea name="processes" cols="70" rows="5" ><?php if(isset($params['processes'])){ echo $params['processes'];} ?></textarea>
			</div>
		</div>
	</div>
	<input type="submit" value="登録" />
</form>

<!-- 登録結果表示 -->
<?php if(isset($results)): ?>
    <div class="results_col">
    <?= $this->element('messages', ['messages' => $messages, 'errors' => $errors]);?>
    <?= $this->element('cocktails/cocktail', ['results' => $results]);?>
    </div>
<?php endif;?>
