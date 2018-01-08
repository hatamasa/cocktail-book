<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use App\Model\Cocktails\CocktailsUtil;
use Cake\Database\Expression\OrderByExpression;

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
            $query->andWhere(['name LIKE' => CocktailsUtil::escapeString($params['name'])]);
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

}