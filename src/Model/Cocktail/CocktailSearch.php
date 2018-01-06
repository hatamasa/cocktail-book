<?php
namespace App\Model\Cocktail;

use Cake\ORM\TableRegistry;

class CocktailSearch
{
    private $params;

    public function __construct($params){
        $this->params = $params;
    }

    /*
     * 検索条件でカクテルを検索する
     */
    public function fetchCocktailByKeyword(){

        $cocktails = TableRegistry::get('cocktails');
        $query = $cocktails
            ->find()
            ->select(['cocktails.id', 'cocktails.name', 'u.name'])
            ->leftJoin(['u' => 'users'],['u.id = cocktails.author_id'])
            ;

        // 検索項目に合わせてSQLを作成
        if(!empty($this->params)){
            $idx = 0;
            foreach ($this->params as $key => $value){
                if($idx == 0){
                    $query->where(['cocktails.' . $key => $value]);
                }else{
                    $query->andWhere(['cocktails.' . $key => $value]);
                }
                $idx++;
            }

            $query->order(['cocktails.name' => 'ASC']);
        }

        return $query->toArray();
    }

}