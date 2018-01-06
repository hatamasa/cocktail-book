<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CocktailsTable extends Table
{
    /**
     * カクテル一覧検索
     * @param  $params
     * @return array
     */
    public function searchCocktails($params){

        $query = $this->query();

        // 検索項目に合わせてSQLを作成
        $query->where(['1' => 1]);
        if(isset($params['name']) && !empty(trim($params['name']))){
            // TODO SQLインジェクション対策をする
            $query->andWhere(['name LIKE' => '%' . $params['name'] . '%']);
        }
        if(isset($params['glass'])){
            $query->andWhere(['glass' => $params['glass']]);
        }
        if(isset($params['percentage'])){
            $query->andWhere(['percentage' => $params['percentage']]);
        }
        if(isset($params['taste'])){
            $query->andWhere(['taste' => $params['taste']]);
        }

        $query->order(['name' => 'ASC']);

        return $query->toArray();
    }
}