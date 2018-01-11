<?php
namespace App\Model\Cocktails;

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

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
    public function fetchCocktailDetail($cocktails_id){
        $results = [];

        $cocktailsTable = TableRegistry::get('Cocktails');
        $results['cocktail'] = $cocktailsTable->get($cocktails_id)->toArray();

        $cocktailElementsTable = TableRegistry::get('CocktailElements');
        $results['elements'] = $cocktailElementsTable->fetchElementsByCocktailId($cocktails_id);

        return $results;
    }

    /**
     * カクテルを登録する
     * @param $params
     */
    public function createCocktail(){

        // カクテルの配列作成
        // TODO ログインしているユーザのIDを設定する
        $data = [
            'name' => $this->params['name'],
            'search_name' => CocktailsUtil::convertTohalfString($this->params['name']),
            'glass' => $this->params['glass'],
            'percentage' => $this->params['percentage'],
            'color' => $this->params['color'],
            'taste' => $this->params['taste'],
            'processes' => $this->params['processes'],
            'author_id' => null
        ];

        // カクテル要素の配列作成
        $cocktail_elements = [];

        foreach ($this->params['element_list_selected'] as $element) {
            $cocktail_elements[] = [
                'elements_id' => $element['elements_id'],
                'amount' => $element['amount'],
            ];
        }

        $data['cocktail_elements'] = $cocktail_elements;

        // エンティティとアソシエーションを作成
        $cocktailsTable = TableRegistry::get('Cocktails');
        $cocktail = $cocktailsTable->newEntity($data, [
            'associated' => ['CocktailElements'],
        ]);

        // 登録
        return $cocktailsTable->save($cocktail);
    }

    /**
     * カテゴリごとのエレメントのリストを取得する
     * @param $category_kbn
     * GET /getElementsOptions/:id
     */
    public function getElementList($category_kbn)
    {
        $elementsRepository = TableRegistry::get('Elements');
        return $elementsRepository->findByCategoryKbn($category_kbn)->toArray();
    }

}