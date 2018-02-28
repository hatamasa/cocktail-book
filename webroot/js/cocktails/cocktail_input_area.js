$(function(){

    // selectボックスの変更イベント
    $('#category').on('change', function() {
        var category = $('#category').val();
        var options = [];
        $('#elements').find('option').each(function(index, element){
            var values = $(element).val().split(',')
            if(values[0] != category){
                $(element).hide();
            }else{
                $(element).show();
            }
        });
    });

    // セレクトボックスを未選択状態にする
    $('#category').prop('selectedIndex', -1);

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
        obj['element_id'] = $('.elements').val();
        obj['amount'] = $('.amount-input').val();

        console.log(obj);
        var csrf = $('input[name=_csrfToken]').val();
        $.ajax({
            url: '/cocktails/mergeElementsTable/',
            type: "POST",
            data: obj,
            beforeSend: function(xhr){
                xhr.setRequestHeader('X-CSRF-Token', csrf);
            }
        }).done(function(data){
            $('#elements-table').html(data);
        });
    });

    // 材料削除ボタン押下イベント
    // #elements-table自体を監視対象にしておいて、第二引数で指定した要素にhitしたら関数が呼ばれる仕組み。
    $('#elements-table').on('click', '.delete-elements', function(){

        var obj = new Object();
        // 選択済み材料を取得
        obj = makeSelectedList(obj);
        // 削除する材料
        obj['del_index'] = $(this).closest('tr').find('.index').val();

        console.log(obj);
        var csrf = $('input[name=_csrfToken]').val();
        $.ajax({
            url: '/cocktails/deleteElementsTable/',
            type: "POST",
            data: obj,
            beforeSend: function(xhr){
                xhr.setRequestHeader('X-CSRF-Token', csrf);
            }
        }).done(function(data){
            $('#elements-table').html(data);
        });
    });

    // 画像アップロード時のイベント
    $('.img').on('change', function(){
        var strFileInfo = $('.img')[0].files[0];
        $('.preview').remove();

        if(strFileInfo && strFileInfo.type.match('image.*')){
          $('.preview-area').append('<img class="preview"/>');

          fileReader = new FileReader();
          fileReader.onload = function(event){
            $('.preview').attr('src', event.target.result);
          }
          fileReader.readAsDataURL(strFileInfo);
        } else {
            $('.preview-area').append('<label class="error preview">プレビューできません。不正な画像ファイルがアップロードされました</label>');
        }
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
        errorPlacement: function(error){
            error.appendTo('.elements-title');
            },
    });
}
// 選択済みの材料リストを取得
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
