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
        if(!$('.cocktail__form').valid()){
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
  $('.cocktail__form').validate({
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
<form action="<?= $this->Url->build('/cocktails/save') ?>" class="cocktail__form" method="post">

<?php if (!strpos($this->request->env('REQUEST_URI'),'edit')):?>
  <h3>カクテルを作成する</h3>
<?php else:?>
  <h3>カクテルを編集する</h3>
  <input type="hidden" name="edit" value="1" />
<?php endif;?>
  <?= $this->element('messages', ['messages' => $messages??[] ]); ?>
  <input type="hidden" name="id" value="<?= $params['id']??'' ?>" />
  <div class="cocktail__block">
    <div class="form-group">
      <?= $this->element('input_errors', ['name' => 'name']); ?>
      <div class="col-label-2">名前</div>
      <div class="col-input-2">
        <input type="text" name="name" id="input-text-1" value="<?= $params['name']??'' ?>" />
      </div>
    </div>
    <div class="form-group">
      <?= $this->element('input_errors', ['name' => 'glass']); ?>
      <div class="col-label-2">グラス</div>
      <div class="col-input-2">
      <?php foreach ($glass_list as $key => $value):?>
        <input type="radio" name="glass" value="<?= $key?>"
        <?php if(($params['glass']??'') == $key): ?>checked="checked"<?php endif; ?> /><?= $value?>
      <?php endforeach; ?>
      </div>
    </div>
    <div class="form-group">
      <?= $this->element('input_errors', ['name' => 'percentage']); ?>
      <div class="col-label-2">強さ</div>
      <div class="col-input-2">
      <?php foreach ($percentage_list as $key => $value):?>
        <input type="radio" name="percentage" value="<?= $key?>"
        <?php if(($params['percentage']??'') == $key): ?>checked="checked"<?php endif; ?> /><?= $value?>
      <?php endforeach; ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-label-2">色</div>
      <div class="col-input-2">
        <input type="text" name="color" id="input-text-1" value="<?= $params['color']??'' ?>" />
      </div>
    </div>
    <div class="form-group">
      <?= $this->element('input_errors', ['name' => 'taste']); ?>
      <div class="col-label-2">味</div>
      <div class="col-input-2">
      <?php foreach ($taste_list as $key => $value):?>
        <input type="radio" name="taste" value="<?= $key?>"
        <?php if(($params['taste']??'') == $key): ?>checked="checked"<?php endif; ?> /><?= $value?>
      <?php endforeach; ?>
      </div>
    </div>
  </div>
  <h4 class="elements-title">材料を選択する</h4>
  <div class="cocktail-elements__block">
          <select class="category" name="category" size="5">
          <?php foreach ($category_list as $key => $value):?>
            <option value="<?=$key?>" <?php if (($params['category']??'') == $key):?>selected<?php endif;?> ><?=$value?></option>
          <?php endforeach;?>
          </select>
          <select class="elements" name="elements" size="5"><!-- Ajaxで生成 --></select>
    <input type="text" class="amount-input" name="amount" value="<?= $params['amount'][0]??'' ?>" placeholder="量を入力..." />
    <input type="button" class="submit-elements" value="材料を追加"/>
    <h4>材料一覧</h4>
    <?= $this->element('input_errors', ['name' => 'elements_id_selected']); ?>
    <table class="elements-table"><?= $this->element('cocktails/ajax_elements_table', ['elements_list_selected' => $elements_list_selected??[]]); ?><!-- Ajaxで生成 --></table>
  </div>
  <div class="cacktail-processes__block">
    <div class="form-group">
      <div class="col-label-2">作成手順</div>
      <div class="col-input-large">
        <textarea name="processes" cols="70" rows="5" ><?= $params['processes']??'' ?></textarea>
      </div>
    </div>
  </div>
  <input type="submit" class="cancel" value="保存する" />
</form>

<!-- 登録結果表示 -->
<?php if(isset($results) && count($results) > 0): ?>
    <div class="results_col">
    <?= $this->element('cocktails/cocktail', ['results' => $results]);?>
    </div>
<?php endif;?>
