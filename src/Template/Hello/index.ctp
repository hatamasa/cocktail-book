<?php
$this->assign('title', 'hello');
?>
<h1><?php echo $data ?></h1>
<form action="/search" method="get">
	<div class="cocktailSearchForm__block">
		<div class="form-group">
			<div class="col-label">名前</div>
			<div class="col-input"><input type="text" name="name" value="山田" /></div>
		</div>
		<div class="form-group">
			<div class="col-label">名前（かな）</div>
			<div class="col-input"><input type="text" name="kana" value="やまだ" /></div>
		</div>
		<div class="form-group">
			<div class="col-label">職業</div>
			<div class="col-input"><input type="text" name="job" value="広告業" /></div>
		</div>
	</div>
	<input type="submit" value="検索" />
</form>