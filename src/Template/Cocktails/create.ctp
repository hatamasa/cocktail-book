<?= $this->element('cocktails/common'); ?>

<script>

$(function(){
	// selectボックスの変更イベント
    $('.category').on("change", function() {
        var id = $(".category").val();
        $(".element").load( "/cocktails//getElementOptions/"+id);
    });

    // submitの押下イベント
    $('.submit-elements').on("click", function() {
        var data = { };
        data['element_list_selected'] = $(".element_list_selected").val;
        data['element_id'] = $(".element").val();
        data['amount'] = $(".amount").val();
        $(".element-table").load( "/cocktails/getElementTable/", data);
    });

}

// 予備
function selectChange(){
    //selectタグ（親） が変更された場合
    $('[name=category]').on('change', function(){
      var category_val = $(this).val();
      var url = "/cocktails/getElementOptions/"+category_val;

      //category_val値 を サーバ へ渡す
      $.get(url).done(function(data){
        //selectタグ（子） の option値 を一旦削除
        $('.element option').remove();
        //select.php から戻って来た data の値をそれそれ optionタグ として生成し、
        // .car_model に optionタグ を追加する
        $.each(data, function(id, name){
          $('.element').append($('<option>').text(name).attr('value', id));
        });
      })
      .fail(function(){
        console.log("失敗");
      });

    });
}

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
        	<div class="select-category">
        		<select class="category" name="category">
        		<?php foreach ($category_list as $key => $value):?>
        			<option value="<?=$key?>" <?php if (isset($params['category']) && $params['category'] == $key):?>selected<?php endif;?> ><?=$value?></option>
        		<?php endforeach;?>
        		</select>
        	</div>
		<div class="select-element">
        		<select class="element" name="element"><!-- Ajaxでooptionを生成 --></select>
		</div>
		<div class="col-label-2">量</div>
		<div class="col-input-2">
			<input type="text" class="amount" name="amount" value="<?php if(isset($params['amount'][0])){ echo $params['amount'][0];} ?>" placeholder="量を入力..."/>
		</div>
		<input type="button" class="submit-elements" value="材料を追加"/>
		<div class="col-label-2">材料一覧</div><!-- TODO $elements_list_selectedをAjaxで作成して表示したい -->
		<input type="hidden" class="element_list_selected" name="element_list_selected" value="<?=$element_list_selected?>" />
		<table class="element-table">
			<?php foreach ($elements_list_selected as $key => $value):?>
			<tr>
				<th><?=$key ?></th>
				<in><?=$value['name']?></td>
				<td><?=$value['amount']?></td>
			</tr>
			<?php endforeach;?>
		</table>
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
    <?= $this->element('cocktail', ['results' => $results]);?>
    </div>
<?php endif;?>
