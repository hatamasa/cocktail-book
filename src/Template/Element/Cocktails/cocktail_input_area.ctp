<input type="hidden" name="id" value="<?= $params['id']??'' ?>" />
<div class="createCocktail__block">
    <h2>画像をアップロード</h2>
    <?= $this->element('input_errors', ['name' => 'img']); ?>
    <?= $this->Form->file('img', ['class' => 'img']); ?>
    <span class="preview-area"><img class="preview" width="225" src="<?=$no_img_url ?>"/></span><!-- プレビューエリア -->
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
            <select class="category" id="category" name="category" size="5">
            <?php foreach ($category_list as $key => $value):?>
                <option value="<?=$key?>" <?php if (($params['category']??'') == $key):?>selected<?php endif;?> ><?=$value?></option>
            <?php endforeach;?>
            </select>
        </span>
        <span>
            <select class="elements" id="elements" name="elements" size="5">
            <?php foreach ($elements_master as $elements):?>
                <option value="<?=$elements['id']?>" <?php if ($params['elements']??'' == $elements['id']):?>selected<?php endif;?> ><?=$elements['name']?></option>
            <?php endforeach;?>
            </select>
        </span>
        <div class="display-flex">
            <input type="text" class="amount-input" name="amount" value="<?= $params['amount'][0]??'' ?>" placeholder="量を入力..." />
            <button type="button" class="btn btn-default btn-sm submit-elements" >材料を追加</button>
        </div>
    </div>
    <h3>材料一覧</h3>
    <?= $this->element('input_errors', ['name' => 'element_id_selected']); ?>
    <table id="elements-table"><!-- Ajaxで生成 -->
        <?= $this->element('Cocktails/ajax_elements_table'); ?>
    </table>
</div>
<div class="createCocktail__block">
    <div class="form-group">
        <h2>作成手順</h2>
        <button type="button" class="btn btn-default btn-sm processes" value="soda" >ソーダ以外の</button>
        <button type="button" class="btn btn-default btn-sm processes" value="shake" >シェーク</button>
        <button type="button" class="btn btn-default btn-sm processes" value="stir">ステア</button>
        <button type="button" class="btn btn-default btn-sm processes" value="mix">ミキシンググラス</button>
        <button type="button" class="btn btn-default btn-sm processes" value="ice">氷を入れた</button>
        <button type="button" class="btn btn-default btn-sm processes" value="clash">クラッシュドアイス</button>
        <button type="button" class="btn btn-default btn-sm processes" value="cocktail-glass">カクテルグラスに注ぐ</button>
        <button type="button" class="btn btn-default btn-sm processes" value="sodain" >ソーダを注ぐ</button>
        <div>
            <textarea name="processes" id="processes" cols="70" rows="5" ><?= $params['processes']??'' ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <h2>タグ</h2>
        <div>
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
<script>
$(() => {

    // セレクトボックスを未選択状態にする
    $('#category').prop('selectedIndex', -1);

    // カテゴリのセレクトボックス変更時の材料セレクトボックスの変更
    $('#category').on('change', () => {
        $('#elements').children().remove();
        let category = $('#category').val();
        <?php foreach ($elements_master as $elements):?>
        if("<?= $elements['category_kbn'] ?>" == category){
            let option = $("<option>").val("<?= $elements['id'] ?>").text("<?= $elements['name'] ?>");
            $("#elements").append(option);
        }
        <?php endforeach;?>
    });

    // 材料追加ボタン押下イベント
    $('.submit-elements').on('click', () => {
        validate();
        if(!$('.cocktail-form').valid()){
            return;
        };

        let obj = new Object();
        // 選択済み材料を取得
        obj = makeSelectedList(obj);
        // 新しく追加する材料を追加
        obj['element_id'] = $('#elements').val();
        obj['amount'] = $('.amount-input').val();

        let csrf = $('input[name=_csrfToken]').val();
        $.ajax({
            url: '/cocktails/mergeElementsTable/',
            type: "POST",
            data: obj,
            beforeSend: xhr => {
                xhr.setRequestHeader('X-CSRF-Token', csrf);
            }
        })
        .done( data => {
            $('#elements-table').html(data);
        });
    });

    // 材料削除ボタン押下イベント
    // #elements-table自体を監視対象にしておいて、第二引数で指定した要素にhitしたら関数が呼ばれる仕組み。
    $('#elements-table').on('click', '.delete-elements', evt => {
        let obj = new Object();
        // 選択済み材料を取得
        obj = makeSelectedList(obj);
        // 削除する材料
        obj['del_index'] = $(evt.target).closest('tr').find('.index').val();

        let csrf = $('input[name=_csrfToken]').val();
        $.ajax({
            url: '/cocktails/deleteElementsTable/',
            type: "POST",
            data: obj,
            beforeSend: xhr => {
                xhr.setRequestHeader('X-CSRF-Token', csrf);
            }
        })
        .done( data => {
            $('#elements-table').html(data);
        });
    });

    // 画像アップロード時のイベント
    $('.img').on('change', () => {
        let strFileInfo = $('.img')[0].files[0];
        $('.preview').remove();

        if(strFileInfo && strFileInfo.type.match('image.*')){
            $('.preview-area').append('<img class="preview"/>');

            fileReader = new FileReader();
            fileReader.onload = event => {
                $('.preview').attr('src', event.target.result);
            }
            fileReader.readAsDataURL(strFileInfo);
        } else {
            $('.preview-area').append('<label class="error preview">プレビューできません。不正な画像ファイルがアップロードされました</label>');
        }
    });

    $('.processes').on('click', evt => {
        let text = String($('#processes').val());
        switch($(evt.target).val()){
            case 'soda':
                $('#processes').val(`${text} ソーダ以外の`);
                break;
            case 'shake':
                $('#processes').val(`${text} 材料をシェークして、`);
                break;
            case 'stir':
                $('#processes').val(`${text} 材料をステアして、`);
                break;
            case 'mix':
                $('#processes').val(`${text} ミキシンググラス`);
                break;
            case 'ice':
                $('#processes').val(`${text} 氷を入れた`);
                break;
            case 'clash':
                $('#processes').val(`${text} クラッシュドアイスを詰めた`);
                break;
            case 'cocktail-glass':
                $('#processes').val(`${text} カクテルグラスに注ぐ`);
                break;
            case 'sodain':
                $('#processes').val(`${text} ソーダを注ぐ`);
                break;
        }

    });

});

//材料追加ボタンのバリデーション
function validate(){
    $('.cocktail-form').validate({
        rules:  {
            elements: {required: true},
            amount: {required: true}
        },
        messages: {
            elements: {
                required: "材料を選択してください"
            },
            amount: {
                required: "量を入力してください"
            },
            onsubmit: false
        },
        //エラーメッセージ出力箇所調整
        errorPlacement: function(error){
            error.appendTo('.elements-title');
        },
    });
}

//選択済みの材料リストを取得
function makeSelectedList(obj){
    // すでに追加されているidを取得
    var obj_id_list = new Object();
    $('#elements-table').find('.saved_id').each(function(i){
        obj_id_list[i] = $(this).val();
    });
    obj['saved_id'] = obj_id_list;

    // すでに追加されているelement_idを取得
    var obj_elements_list = new Object();
    $('#elements-table').find('.element_id_selected').each(function(i){
        obj_elements_list[i] = $(this).val();
    });
    obj['element_id_selected'] = obj_elements_list;

    // すでに追加されているamountを取得
    var obj_amount_list = new Object();
    $('#elements-table').find('.amount_selected').each(function(i){
        obj_amount_list[i] = $(this).val();
    });
    obj['amount_selected'] = obj_amount_list;

    return obj;
}

</script>