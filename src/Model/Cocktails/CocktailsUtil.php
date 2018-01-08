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

        return "%" . mb_ereg_replace('([_%#])', '\\\1', $s) . "%";
    }
}