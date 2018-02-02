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

            ->requirePresence('element_id_selected', true, '材料は少なくとも一つ以上入力してください')
                ;

        return $validator->errors($this->params);
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
        $results['cocktail_elements'] = $cocktailElementsTable->fetchElementsByCocktailId($cocktail_id);

        return $results;
    }

    /**
     * カクテルを登録する
     * @param $params
     */
    public function saveCocktail(){

        // カクテルの配列作成
        $data = [
            'id' => $this->params['id']??'',
            'name' => $this->params['name'],
            'search_name' => CocktailsUtil::tohalfString($this->params['name']),
            'glass' => $this->params['glass'],
            'percentage' => $this->params['percentage'],
            'color' => $this->params['color'],
            'taste' => $this->params['taste'],
            'processes' => $this->params['processes'],
        ];

        // カクテル要素の配列作成
        for ($i = 0; $i < count($this->params['element_id_selected']); $i++){
            $data['cocktail_elements'][] = [
                'id' => $this->params['saved_id'][$i]??'',
                'cocktail_id' => $this->params['id'],
                'element_id' => $this->params['element_id_selected'][$i],
                'amount' => $this->params['amount_selected'][$i],
            ];
        }

        // カクテルタグの配列作成
        if(isset($this->params['tag_id_selected'])){
            foreach ($this->params['tag_id_selected'] as $tag_id){
                $data['cocktail_tags'][] = [
                    'id' => '',
                    'cocktail_id' => $this->params['id'],
                    'tag_id' => $tag_id,
                ];
            }
        }

        // エンティティとアソシエーションを作成
        $cocktailsTable = TableRegistry::get('Cocktails');
        $cocktailElementsTable = TableRegistry::get('CocktailElements');
        $cocktailTagsTable = TableRegistry::get('CocktailTags');

        $connection = ConnectionManager::get('default');
        $connection->begin();
        try{
            // patchEntityのみではアソシエーション削除の場合、削除されない
            // そのためCocktailElements, CocktailTagsを全削除して入れ直す
            $cocktailElementsTable->deleteAll(['cocktail_id' => $this->params['id']]);
            $cocktailTagsTable->deleteAll(['cocktail_id' => $this->params['id']]);

            $cocktail = $cocktailsTable->newEntity();
            $cocktail = $cocktailsTable->patchEntity($cocktail, $data, [
                'associated' => ['CocktailElements', 'CocktailTags'],
            ]);
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
        for ($i = 0; $i < count($this->params['element_id_selected']); $i++){
            $elements_list[$i] = $elementsRepository->findById($this->params['element_id_selected'][$i])->first();
            $elements_list[$i]['saved_id'] = $this->params['saved_id'][$i]??'';
            $elements_list[$i]['amount'] = $this->params['amount_selected'][$i];
        }
        return $elements_list;
    }

    /**
     * タグ番号の配列からタグ検索用の2進数配列を作成する
     * @param array タグ番号の配列
     */
    private function makeTagsBinaryDigit(array $tags_digit)
    {
        // TODO タグidからタグマスタを検索し、取得したタグ検索配列番号のビットを1にする
    }

}