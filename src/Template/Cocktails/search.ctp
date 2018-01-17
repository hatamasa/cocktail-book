<!-- 検索フォーム -->
<div class="title__block">
  <h1>カクテルを検索する</h1>
</div>
<div class="cocktailSearchForm__block">
<form action="<?= $this->Url->build('/cocktails/search') ?>" method="get">
    <div class="form-group">
        <input type="text" id="name-search-input" name="name" value="<?= $params['name']??'' ?>" placeholder="カクテルの名前を入力..." />
    </div>
    <div class="form-group">
      <h2>グラス</h2>
      <div class="col-input-1">
      <?php foreach ($glass_list as $key => $value):?>
        <input type="checkbox" name="glass[]" value="<?= $key?>"
        <?php if(in_array($key, $params['glass']??[])): ?>checked="checked"<?php endif; ?> /><?= $value?>
      <?php endforeach; ?>
      </div>
    </div>
    <div class="form-group">
      <h2>強さ</h2>
      <div class="col-input-1">
      <?php foreach ($percentage_list as $key => $value):?>
        <input type="checkbox" name="percentage[]" value="<?= $key?>"
        <?php if(in_array($key, $params['percentage']??[])): ?>checked="checked"<?php endif; ?> /><?= $value?>
      <?php endforeach; ?>
      </div>
    </div>
    <div class="form-group">
      <h2>味</h2>
      <div class="col-input-1">
      <?php foreach ($taste_list as $key => $value):?>
        <input type="checkbox" name="taste[]" value="<?= $key?>"
        <?php if(in_array($key, $params['taste']??[])): ?>checked="checked"<?php endif; ?> /><?= $value?>
      <?php endforeach; ?>
      </div>
    </div>
  <input type="submit" value="検索" />
</form>
</div>
<!-- 検索結果表示 -->
<div class="results__block">
<?php if(isset($results)):?>
    <?php foreach ($results as $row): ?>
    <?= $this->element('cocktails/cocktail', ['row' => $row]);?>
    <?php endforeach; ?>
<?php endif;?>
</div>