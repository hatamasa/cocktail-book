<?php
echo $this->element('cocktails/common');
?>

<!-- 検索フォーム -->
<form action="./search" method="get">
	<div class="cocktailSearchForm__block">
		<div class="form-group">
			<div class="col-label">名前</div>
			<div class="col-input">
				<input type="text" name="name" value="<?php if(isset($params['name'])): ?><?php echo $params['name'] ?><?php endif;?>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-label">グラス</div>
			<div class="col-input">
			<?php foreach ($glass_list as $key => $value):?>
				<input type=checkbox name="glass[]" value="<?php echo $key?>"
				<?php if(isset($params['glass']) && in_array($key, $params['glass'])): ?>checked="checked"<?php endif; ?> /><?php echo $value?>
			<?php endforeach; ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-label">強さ</div>
			<div class="col-input">
			<?php foreach ($percentage_list as $key => $value):?>
				<input type=checkbox name="percentage[]" value="<?php echo $key?>"
				<?php if(isset($params['percentage']) && in_array($key, $params['percentage'])): ?>checked="checked"<?php endif; ?> /><?php echo $value?>
			<?php endforeach; ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-label">味</div>
			<div class="col-input">
			<?php foreach ($taste_list as $key => $value):?>
				<input type=checkbox name="taste[]" value="<?php echo $key?>"
				<?php if(isset($params['taste']) && in_array($key, $params['taste'])): ?>checked="checked"<?php endif; ?> /><?php echo $value?>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
	<input type="submit" value="検索" />
</form>

<!-- 検索結果表示 -->
<?php if(isset($results)): ?>
<div class="results_col">
<?php echo $this->element('messages', ['messages' => $messages]);?>
    	<?php foreach ($results as $row): ?>
     <ul>
        	<li class="cocktail_name"><?php echo $row['name']?></li>
        	<li>グラス：<?php echo $glass_list[$row['glass']]?></li>
        	<li>強さ： <?php echo $percentage_list[$row['percentage']]?></li>
        	<li>色： <?php echo $row['color']?></li>
        	<li>味： <?php echo $taste_list[$row['taste']]?></li>
     </ul>
     <input type="hidden" name="id" value=<?php echo $row['id']?> />
    <?php endforeach; ?>
</div>
<?php endif;?>