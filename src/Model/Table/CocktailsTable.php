<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use App\Model\Cocktails\CocktailsUtil;

class CocktailsTable extends Table
{
    /**
     * カクテル一覧を検索する
     * @param  $params
     * @return array
     */
    public function fetchAllCocktails($params){

        $query = $this->query();

        // 検索項目に合わせてSQLを作成
        $query->where(['1' => 1]);
        if(isset($params['name']) && !empty(trim($params['name']))){
            // TODO 検索用名前から検索したい
            $query->andWhere(['search_name LIKE' => $this->convertToSearchString($params['name'])]);
        }
        if(isset($params['glass'])){
            $query->andWhere(['glass IN' => $params['glass']]);
        }
        if(isset($params['percentage'])){
            $query->andWhere(['percentage IN' => $params['percentage']]);
        }
        if(isset($params['taste'])){
            $query->andWhere(['taste IN' => $params['taste']]);
        }

        $query->order(['name' => 'ASC']);

        return $query->toArray();
    }

    /**
     * 検索用名前取得
     * @param $str
     * @return string
     */
    private function convertToSearchString($str){

        $str = CocktailsUtil::convertToHalfString($str);
        $str = CocktailsUtil::escapeString(trim($str));
        return $str;
    }

}