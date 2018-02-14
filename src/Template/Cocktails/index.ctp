<!-- 検索フォーム -->
<div class="title__wrapper">
    <h1>カクテルを検索する</h1>
</div>
<div class="cocktailSearch__wrapper">
    <form action="<?= $this->Url->build('/cocktails/search') ?>" method="get">
        <div class="form-group">
            <input type="text" class="name-search-input" name="name" value="<?= $params['name']??'' ?>" placeholder="カクテルの名前を入力..." />
        </div>
        <div class="form-group">
            <h2>グラスタイプ</h2>
            <ul class="form-input-check display-inline-ul">
                <?php foreach ($glass_list as $key => $value):?>
                <li>
                    <label>
                        <input type="checkbox" class="checkbox-input" name="glass[]" value="<?= $key?>" <?php if(in_array($key, $params['glass']??[])): ?> checked="checked" <?php endif; ?> />
                        <span class="checkbox-span"><?= $value?></span>
                    </label>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="form-group">
            <h2>強さ</h2>
            <ul class="form-input-check display-inline-ul">
                <?php foreach ($percentage_list as $key => $value):?>
                <li>
                    <label>
                        <input type="checkbox" class="checkbox-input" name="percentage[]" value="<?= $key?>" <?php if(in_array($key, $params['percentage']??[])): ?> checked="checked" <?php endif; ?> />
                        <span class="checkbox-span"><?= $value?></span>
                    </label>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="form-group">
            <h2>テイスト</h2>
            <ul class="form-input-check display-inline-ul">
                <?php foreach ($taste_list as $key => $value):?>
                <li>
                    <label>
                        <input type="checkbox" class="checkbox-input" name="taste[]" value="<?= $key?>" <?php if(in_array($key, $params['taste']??[])): ?> checked="checked" <?php endif; ?> />
                        <span class="checkbox-span"><?= $value?></span>
                    </label>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="form-group">
            <h2>タグから検索する</h2>
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
        <button type="submit" class="btn btn-default btn-full" >検索</button>
    </form>
</div>