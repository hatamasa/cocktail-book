<?php
namespace App\Model\Cocktails;

class CocktailsUtil
{
    /**
     * //ワイルドカードをエスケープする
     * @param $s
     * @return string
     */
    static public function escapeString($s) {

        return "%" . mb_ereg_replace('([_%])', '\\\1', $s) . "%";
    }

    /**
     * 半角に変換
    * r	「全角」英字を「半角」に変換
    * n	「全角」数字を「半角」に変換
    * a	「全角」英数字を「半角」に変換
    * s	「全角」スペースを「半角」に変換（U+3000 → U+0020）
    * k	「全角カタカナ」を「半角カタカナ」に変換
    * h	「全角ひらがな」を「半角カタカナ」に変換
    * @return string
    */
    static public function toHalfString($str){

        return mb_convert_kana($str, 'rnaskh');
    }
}