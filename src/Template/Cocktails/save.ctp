<script>

$(function(){

    // selectボックスの変更イベント
    $('.category').on('change keyup', function() {
        var id = $('.category').val();
        $('.elements').load( '/cocktails/getElementsOptions/'+id);
    });

    // セレクトボックスを未選択状態にする
    $('.category').prop('selectedIndex', -1);

    // 材料追加ボタン押下イベント
    $('.submit-elements').on('click', function() {

        validate();
        if(!$('.cocktail-form').valid()){
            return;
        };

        var obj = new Object();
        // 選択済み材料を取得
        obj = makeSelectedList(obj);
        // 新しく追加する材料を追加
        obj['elements_id'] = $('.elements').val();
        obj['amount'] = $('.amount-input').val();

        console.log(obj);
        $('.elements-table').load( '/cocktails/mergeElementsTable/', obj);
    });

    // 材料削除ボタン押下イベント
    // .elements-table自体を監視対象にしておいて、第二引数で指定した要素にhitしたら関数が呼ばれる仕組み。
    $('.elements-table').on('click', '.delete-elements', function(){

        var obj = new Object();
        // 選択済み材料を取得
        obj = makeSelectedList(obj);
        // 削除する材料
        obj['del_index'] = $(this).closest('tr').find('.index').val();

        console.log(obj);
        $('.elements-table').load( '/cocktails/deleteElementsTable/', obj);
    });

});

// 材料追加ボタンのバリデーション
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
        errorPlacement: function(error, element){
            error.appendTo('.elements-title');
            },
    });
}
// 選択済みの材料リストを取得
function makeSelectedList(obj){
    // すでに追加されているidを取得
    var obj_id_list = new Object();
    $('.elements-table').find('.saved_id').each(function(i){
        obj_id_list[i] = $(this).val();
    });
    obj['saved_id'] = obj_id_list;

    // すでに追加されているelements_idを取得
    var obj_elements_list = new Object();
    $('.elements-table').find('.elements_id_selected').each(function(i){
        obj_elements_list[i] = $(this).val();
    });
    obj['elements_id_selected'] = obj_elements_list;

    // すでに追加されているamountを取得
    var obj_amount_list = new Object();
    $('.elements-table').find('.amount_selected').each(function(i){
        obj_amount_list[i] = $(this).val();
    });
    obj['amount_selected'] = obj_amount_list;

    return obj;
}

</script>
<!-- フォーム -->
<div class="title__wrapper">
<?php if (($edit??'' == 'edit') || isset($params['edit'])):?>
    <h1>カクテルを編集する</h1>
    <input type="hidden" name="edit" value="edit" />
<?php else:?>
    <h1>カクテルを作成する</h1>
<?php endif;?>
</div>
<div class="createCocktail__wrapper">
    <form action="<?= $this->Url->build('/cocktails/save') ?>" class="cocktail-form" method="post">
        <input type="hidden" name="id" value="<?= $params['id']??'' ?>" />
        <div class="createCocktail__block">
            <div class="form-group display-flex">
                <?= $this->element('input_errors', ['name' => 'name']); ?>
                <div class="form-label-inline">名前</div>
                <input type="text" class="input-text-1" name="name" value="<?= $params['name']??'' ?>" />
            </div>
            <div class="form-group display-flex">
                <?= $this->element('input_errors', ['name' => 'glass']); ?>
                <div class="form-label-inline">グラス</div>
                <?php foreach ($glass_list as $key => $value):?>
                    <input type="radio" id="<?= $key?>" name="glass" value="<?= $key?>"
                    <?php if(($params['glass']??'') == $key): ?>checked="checked"<?php endif; ?> />
                    <label for="<?= $key?>" class="radio-label"><?= $value?></label>
                <?php endforeach; ?>
            </div>
            <div class="form-group display-flex">
                <?= $this->element('input_errors', ['name' => 'percentage']); ?>
                <div class="form-label-inline">強さ</div>
                <?php foreach ($percentage_list as $key => $value):?>
                    <input type="radio" name="percentage" value="<?= $key?>"
                    <?php if(($params['percentage']??'') == $key): ?>checked="checked"<?php endif; ?> /><?= $value?>
                <?php endforeach; ?>
            </div>
            <div class="form-group display-flex">
                <div class="form-label-inline">色</div>
                <input type="text" class="input-text-1" name="color" value="<?= $params['color']??'' ?>" />
            </div>
            <div class="form-group display-flex">
                <?= $this->element('input_errors', ['name' => 'taste']); ?>
                <div class="form-label-inline">味</div>
                <?php foreach ($taste_list as $key => $value):?>
                    <input type="radio" name="taste" value="<?= $key?>"
                    <?php if(($params['taste']??'') == $key): ?>checked="checked"<?php endif; ?> /><?= $value?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="createCocktailElements__block">
            <h2 class="elements-title">材料を選択する</h2>
            <div class="elements-select__inner">
                <select class="category" name="category" size="5">
                <?php foreach ($category_list as $key => $value):?>
                    <option value="<?=$key?>" <?php if (($params['category']??'') == $key):?>selected<?php endif;?> ><?=$value?></option>
                <?php endforeach;?>
                </select>
                <select class="elements" name="elements" size="5"><!-- Ajaxで生成 --></select>
                <input type="text" class="amount-input" name="amount" value="<?= $params['amount'][0]??'' ?>" placeholder="量を入力..." />
                <input type="button" class="submit-elements" value="材料を追加"/>
            </div>
            <h3>材料一覧</h3>
            <?= $this->element('input_errors', ['name' => 'elements_id_selected']); ?>
            <table class="elements-table"><!-- Ajaxで生成 -->
                <?= $this->element('cocktails/ajax_elements_table', ['elements_list_selected' => $elements_list_selected??[]]); ?>
            </table>
        </div>
        <div class="createCocktail__block">
            <div class="form-group">
                <div class="form-label-inline">作成手順</div>
                <div class="col-input-large">
                    <textarea name="processes" cols="70" rows="5" ><?= $params['processes']??'' ?></textarea>
                </div>
            </div>
        </div>
        <input type="submit" class="cancel" value="保存する" />
    </form>
</div>
<!-- 登録結果表示 -->
<div class="results__wrapper">
<?php if(isset($results) && count($results) > 0):?>
    <?= $this->element('cocktails/cocktail', ['row' => $results]);?>
<?php endif;?>
</div>
