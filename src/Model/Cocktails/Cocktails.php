<?php
namespace App\Model\Cocktails;

use Cake\ORM\TableRegistry;

class Cocktails
{

    private $params;

    private $errors = [];

    public function __construct($params = null){
        $this->params = $params;
    }

    /**
     * バリデーションを実行する
     * @return array
     */
    public function validate(){

        // nameパラメータがない、またはnameが空でパラメータが他にない場合
        if(!isset($this->params['name']) ||(empty(trim($this->params['name'])) && count($this->params) <= 1)){
            $this->errors[] = "検索条件を入力してください";
        }

        return $this->errors;
    }

    /**
     * カクテル詳細を取得する
     * @param $id
     * @return array
     */
    public function fetchCocktailDetail($cocktail_id){
        $results = [];

        $cocktails = TableRegistry::get('Cocktails');
        $results['cocktail'] = $cocktails->get($cocktail_id)->toArray();

        $cocktailElements = TableRegistry::get('CocktailElements');
        $results['elements'] = $cocktailElements->fetchElementsByCocktailId($cocktail_id);

        return $results;
    }
}