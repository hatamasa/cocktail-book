<?php
namespace App\Model\Cocktails;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

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
     * カクテル登録用のバリデーションを実行する
     */
    public function valudateForCreate()
    {
        $validator = new Validator();
        $validator
            ->requirePresence('name', true, 'グラスの入力は必須です')
            ->notEmpty('name', '名前の入力は必須です')
            ->add('name', 'length', [
                'rule' => ['maxLength', 30],
                'message' => '名前は30文字以内で入力ください'])

            ->requirePresence('glass', true, 'グラスの入力は必須です')

            ->requirePresence('percentage', true, '強さの入力は必須です')

            ->allowEmpty('color')
            ->add('color', 'length', [
                'rule' => ['maxLength', 10],
                'message' => '色は10文字以内で入力ください'])

            ->requirePresence('taste', true, 'テイストの入力は必須です')

            ->allowEmpty('processes')
            ->add('processes', 'length', [
                    'rule' => ['maxLength', 250],
                    'message' => '作成手順は250文字以内で入力ください'])

            ->requirePresence('elements_id_selected', true, '材料は少なくとも一つ以上入力してください')
                ;

        return $validator->errors($this->params);
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
        $results['cocktail_elements'] = $cocktailElementsTable->fetchElementsByCocktailId($cocktails_id);

        return $results;
    }

    /**
     * カクテルを登録する
     * @param $params
     */
    public function createCocktail($edit = null){

        // カクテルの配列作成
        // TODO ログインしているユーザのIDを設定する
        $data = [
            'id' => $this->params['id']??'',
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

        for ($i = 0; $i < count($this->params['elements_id_selected']); $i++){
            $cocktail_elements[] = [
                'id' => $this->params['saved_id'][$i]??'',
                'elements_id' => $this->params['elements_id_selected'][$i],
                'amount' => $this->params['amount_selected'][$i],
            ];
        }

        $data['cocktail_elements'] = $cocktail_elements;

        // エンティティとアソシエーションを作成
        $cocktailsTable = TableRegistry::get('Cocktails');
        $cocktailElementsTable = TableRegistry::get('CocktailElements');

        $connection = ConnectionManager::get('default');
        $connection->begin();
        try{

            if($edit == 'edit'){
                // patchEntityのみではCocktailElementsがUPDATEされないで新規追加されてしまう
                // そのためCocktailElementsを全削除して入れ直す
                $cocktailElementsTable->deleteAll(['cocktails_id' => $this->params['id']]);

                $cocktail = $cocktailsTable->get($this->params['id'], ['contain' => 'CocktailElements']);
                $cocktail = $cocktailsTable->patchEntity($cocktail, $data, [
                    'associated' => ['CocktailElements'],
                ]);
            }else{
                $cocktail = $cocktailsTable->newEntity($data, [
                    'associated' => ['CocktailElements'],
                ]);
            }
            $result = $cocktailsTable->save($cocktail);
            $connection->commit();

        } catch (\Exception $e){

            $connection->rollback();
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * カテゴリごとのエレメントのリストを取得する
     * @param $category_kbn
     */
    public function getElementsList($category_kbn)
    {
        $elementsRepository = TableRegistry::get('Elements');
        return $elementsRepository->findByCategoryKbn($category_kbn)->toArray();
    }

    /**
     * IDからエレメントを取得して表示用リストを作成する
     * @return array $elements
     */
    public function makeElementsTableList(){
        $elementsRepository = TableRegistry::get('Elements');
        $elements_list = [];
        for ($i = 0; $i < count($this->params['elements_id_selected']); $i++){
            $elements_list[$i] = $elementsRepository->findById($this->params['elements_id_selected'][$i])->first();
            $elements_list[$i]['saved_id'] = $this->params['saved_id'][$i]??'';
            $elements_list[$i]['amount'] = $this->params['amount_selected'][$i];
        }
        return $elements_list;
    }

}