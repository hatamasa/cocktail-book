<!-- 検索フォーム -->
<div class="title__wrapper">
    <h1>材料管理</h1>
</div>
<div class="elementsSearch__wrapper">
    <form action="<?= $this->Url->build('/elements/search') ?>" method="get">
        <div class="form-group">
            <h2>カテゴリ</h2>
            <ul class="form-input-check display-inline">
                <?php foreach ($category_list as $key => $value):?>
                <li class="line-style-none float-left">
                    <input type="radio" id="<?=$key ?>" name="caegory_kbn" value="<?= $key?>" <?php if(($params['category_kbn']??'') == $key): ?>checked="checked"<?php endif; ?> />
                    <label for="<?=$key ?>" class="radio-label"><?= $value?></label>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <button type="submit" class="btn btn-default" >絞り込む</button>
    </form>
</div>
<!-- 結果表示 -->
<?php if(isset($results)):?>
    <table>
        <tr>
            <th>カテゴリー</th>
            <th>材料名</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($results as $row):?>
        <tr>
            <td><?= $category_list[$row['category_kbn']] ?></td>
            <td><?= $row['name'] ?></td>
            <td><a href="/elements/<?= $row['id'] ?>/edit"><button type='button' class="btn btn-default btn-sm" name="edit">編集</button></a></td>
            <td><button type='button' class="btn btn-default btn-sm" name="delete">削除</button></td>
        </tr>
        <?php endforeach;?>
    </table>
<?php endif; ?>
