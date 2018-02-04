<?php
namespace App\Model\Table;

use App\Model\Cocktails\CocktailsUtil;
use Cake\ORM\Table;

class CocktailsTable extends Table
{
    public function initialize(array $config){
        $this->hasMany('CocktailsElements')
        ->setForeignKey('cocktail_id');

        $this->belongsToMany('Tags');
    }

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
        if(isset($params['tag_id'])){
            $query
                ->innerJoin(['ct' => 'cocktails_tags'], ['Cocktails.id = ct.cocktail_id'])
                ->andWhere(['ct.tag_id IN' => $params['tag_id']]);
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