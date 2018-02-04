<input type="hidden" name="id" value="<?= $params['id']??'' ?>" />
<div class="createCocktail__block">
    <table>
        <tr>
            <th class="table-header-md">名前</th>
            <td><?= $this->element('input_errors', ['name' => 'name']); ?>
            <input type="text" class="input-text-1" name="name" value="<?= $params['name']??'' ?>" /></td>
        </tr>
        <tr>
            <th class="table-header-md">グラスタイプ</th>
            <td class="display-inline"><?= $this->element('input_errors', ['name' => 'glass']); ?>
                <?php foreach ($glass_list as $key => $value):?>
                <input type="radio" id="glass<?=$key ?>" name="glass" value="<?= $key?>" <?php if(($params['glass']??'') == $key): ?>checked="checked"<?php endif; ?> />
                <label for="glass<?= $key?>" class="radio-label"><?= $value?></label>
                <?php endforeach; ?>
            </td>
        </tr>
        <tr>
            <th class="table-header-md">強さ</th>
            <td><?= $this->element('input_errors', ['name' => 'percentage']); ?>
                <?php foreach ($percentage_list as $key => $value):?>
                <input type="radio" id="percentage<?=$key ?>" name="percentage" value="<?= $key?>" <?php if(($params['percentage']??'') == $key): ?>checked="checked"<?php endif; ?> />
                <label for="percentage<?=$key ?>" class="radio-label"><?= $value?></label>
                <?php endforeach; ?>
            </td>
        </tr>
        <tr>
            <th class="table-header-md">色</th>
            <td><input type="text" class="input-text-1" name="color" value="<?= $params['color']??'' ?>" /></td>
        </tr>
        <tr>
            <th class="table-header-md">テイスト</th>
            <td><?= $this->element('input_errors', ['name' => 'taste']); ?>
                <?php foreach ($taste_list as $key => $value):?>
                <input type="radio" id="taste<?=$key ?>" name="taste" value="<?= $key?>" <?php if(($params['taste']??'') == $key): ?>checked="checked"<?php endif; ?> />
                <label for="taste<?=$key ?>" class="radio-label"><?= $value?></label>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>
</div>
<div class="createCocktailElements__block">
    <h2 class="elements-title">材料を選択する</h2>
    <div class="elements-select__inner">
        <span>
            <select class="category" name="category" size="5">
            <?php foreach ($category_list as $key => $value):?>
                <option value="<?=$key?>" <?php if (($params['category']??'') == $key):?>selected<?php endif;?> ><?=$value?></option>
            <?php endforeach;?>
            </select>
        </span>
        <span>
            <select class="elements" name="elements" size="5"><!-- Ajaxで生成 --></select>
        </span>
        <div class="display-flex">
            <input type="text" class="amount-input" name="amount" value="<?= $params['amount'][0]??'' ?>" placeholder="量を入力..." />
            <button type="button" class="btn btn-default btn-sm submit-elements" >材料を追加</button>
        </div>
    </div>
    <h3>材料一覧</h3>
    <?= $this->element('input_errors', ['name' => 'element_id_selected']); ?>
    <table class="elements-table"><!-- Ajaxで生成 -->
        <?= $this->element('Cocktails/ajax_elements_table'); ?>
    </table>
</div>
<div class="createCocktail__block">
    <div class="form-group">
        <h2>作成手順</h2>
        <div class="col-input-large">
            <textarea name="processes" cols="70" rows="5" ><?= $params['processes']??'' ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <h2>タグ</h2>
        <div class="col-input-large">
            <ul class="form-input-check display-inline-ul">
            <?php foreach ($tags_master as $tag):?>
            <li>
                <label>
                    <input type="checkbox" class="checkbox-input" name="tag_id[]" value="<?= $tag['id']?>" <?php if(in_array($tag['id'], $params['tag_id']??[])): ?> checked="checked" <?php endif; ?> />
                    <span class="checkbox-span"><?= $tag['name']?></span>
                </label>
            </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>