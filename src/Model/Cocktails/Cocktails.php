<?php
namespace App\Model\Cocktails;

use Cake\ORM\TableRegistry;
use App\Model\Entity\Cocktail;
use App\Model\Entity\CocktailElement;

class Cocktails
{

    private $params;

    private $errors = [];

    public function __construct($params = null){
        $this->params = $params;
    }

    /**
     * カクテル検索時のバリデーションを実行する
     * @return array
     */
    public function validateForSearch(){

        // nameパラメータがない、またはnameが空でパラメータが他にない場合
        if(!isset($this->params['name']) ||(empty(trim(mb_convert_kana($this->params['name'], 's'))) && count($this->params) <= 1)){
            $this->errors[] = "検索条件を入力してください";
        }

        return $this->errors;
    }

    /**
     * 未完成 カクテル登録用のバリデーションを実行する
     */
    public function valudateForCreate()
    {
        // TODO 実装
        return $this->errors;
    }

    /**
     * カクテル詳細を取得する
     * @param $id
     * @return array
     */
    public function fetchCocktailDetail($cocktail_id){
        $results = [];

        $cocktailsTable = TableRegistry::get('Cocktails');
        $results['cocktail'] = $cocktailsTable->get($cocktail_id)->toArray();

        $cocktailElementsTable = TableRegistry::get('CocktailElements');
        $results['elements'] = $cocktailElementsTable->fetchElementsByCocktailId($cocktail_id);

        return $results;
    }

    /**
     * カクテルを登録する
     * @param $params
     */
    public function createCocktail(){

        // カクテルの配列作成
        $data = [
            'name' => $this->params['name'],
            'search_name' => CocktailsUtil::convertTohalfString($this->params['name']),
            'glass' => $this->params['glass'],
            'percentage' => $this->params['percentage'],
            'color' => $this->params['color'],
            'taste' => $this->params['taste'],
            'processes' => $this->params['processes'],
            'author_id' => $this->params['author_id']
        ];

        // カクテル要素の配列作成
        $cocktail_elements = [];

        for ($i = 0 ; $i < count($this->params['element_id']); $i++) {
            $cocktail_elements[] = [
                'element_id' => $this->params["element_id"][$i],
                'amount' => $this->params["amount"][$i],
            ];
        }

        $data['cocktail_elements'] = $cocktail_elements;

        // エンティティとアソシエーションを作成
        $cocktailsTable = TableRegistry::get('Cocktails');
        $cocktail = $cocktailsTable->newEntity($data, [
            'associated' => ['CocktailElements']
        ]);
        // 登録
        return $cocktailsTable->save($cocktail);
    }

}