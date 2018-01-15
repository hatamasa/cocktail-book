<script>

$(function(){
	// selectボックスの変更イベント
    $('.category').on('change keyup', function() {
        var id = $('.category').val();
        $('.elements').load( '/cocktails/getElementsOptions/'+id);
    });

    // submitの押下イベント
    $('.submit-elements').on('click', function() {
        var obj = new Object();
        // 新しく追加する材料
        obj['elements_id'] = $('.elements').val();
        obj['amount'] = $('.amount-input').val();

        // すでに追加されているelements_idを取得
        var obj_elements_list = new Object;
        $('.elements-table').find('.elements_id_selected').each(function(i){
            obj_elements_list[i] = $(this).val();
        });
        obj['elements_id_selected'] = obj_elements_list;

        // すでに追加されているamountを取得
        var obj_amount_list = new Object;
        $('.elements-table').find('.amount_selected').each(function(i){
            obj_amount_list[i] = $(this).val();
        });
        obj['amount_selected'] = obj_amount_list;

        console.log(obj);
        $('.elements-table').load( '/cocktails/mergeElementsTable/', obj);
    });

    // セレクトボックスを未選択状態にする
    $('.category').prop('selectedIndex', -1);

});

</script>
<!-- フォーム -->
<form action="<?= $this->Url->build('/cocktails/create') ?>" method="post">
	<h3>カクテルを作成する</h3>
	<?= $this->element('messages', ['messages' => $messages, 'errors' => $errors]);?>
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
	<div class="cocktail-elements__block">
        	<select class="category" name="category" size="5">
        	<?php foreach ($category_list as $key => $value):?>
        		<option value="<?=$key?>" <?php if (isset($params['category']) && $params['category'] == $key):?>selected<?php endif;?> ><?=$value?></option>
        	<?php endforeach;?>
        	</select>
        	<select class="elements" name="elements" size="5"><!-- Ajaxで生成 --></select>
		<input type="text" class="amount-input" name="amount" value="<?php if(isset($params['amount'][0])){ echo $params['amount'][0];} ?>" placeholder="量を入力..."/>
		<input type="button" class="submit-elements" value="材料を追加"/>
		<div class="submit-elements-label">材料一覧</div>
		<table class="elements-table"><!-- Ajaxで生成 --></table>
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
<?php if(isset($results) && count($results) > 0): ?>
    <div class="results_col">
    <?= $this->element('cocktails/cocktail', ['results' => $results]);?>
    </div>
<?php endif;?>
