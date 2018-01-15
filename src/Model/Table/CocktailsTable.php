<?php
namespace App\Model\Table;

use Cake\Datasource\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Cocktails\CocktailsUtil;

class CocktailsTable extends Table
{
    public function initialize(array $config){
        $this->hasMany('CocktailElements')
        ->setForeignKey('cocktails_id');
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->validCount('CocktailElements', 10, '<=', '材料は 10 つ以下にしてください'));
        $rules->add($rules->validCount('CocktailElements', 1, '>=', '材料は 1 つ以上必要です'));

        return $rules;
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