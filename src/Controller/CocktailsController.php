<?php
namespace App\Controller;

use App\Model\Cocktails\Cocktails;

/**
 * カクテルコントローラ
 * /cocktails
 * @author hatamasa
 */
class CocktailsController extends AppController
{

    /**
     * 初期表示
     * GET /
     */
    public function index()
    {
        $this->render('search');
    }

    /**
     * カクテル検索
     * GET /search
     * @param　$param
     */
    public function search()
    {
        $results = [];
        $messages = [];
        $params = $this->request->getQueryParams();

        $cocktails = new Cocktails($params);
        $errors = $cocktails->validateForSearch();

        if (! $errors) {
            $results = $this->Cocktails->fetchAllCocktails($params);

            if (count($results) == 0) {
                $messages[] = "検索結果はありません";
            } else {
                $messages[] = count($results) . "件ヒットしました";
            }
        }

        $this->set('results', $results);
        $this->set('errors', $errors);
        $this->set('messages', $messages);
        $this->set('params', $params);
    }

    /**
     * カクテル詳細表示
     * GET /:id
     */
    public function show($id)
    {
        $cocktails = new Cocktails();
        $results = $cocktails->fetchCocktailDetail($id);

        $this->set('cocktail', $results['cocktail']);
        $this->set('elements', $results['elements']);
    }

    /**
     * カクテル登録
     * memo: newは予約語のため表示と作成を一括にした
     * GET|POST /create
     */
    public function create()
    {
        $errors = [];
        $messages = [];
        $results = [];
        $params = $this->request->getData();

        // getの時は表示のみ、postの時は登録処理を行う
        if($this->request->is('post')){
            // 登録時処理
            $cocktails = new Cocktails($params);
            $errors = $cocktails->valudateForCreate();

            // バリデエラーがない場合、登録を行う
            // バリデエラーがある場合、かつ追加されている材料リストがある場合、入力保持のため材料リストを作成する
            if(!$errors){
                try{
                    list($results, $errors) = $cocktails->createCocktail();
                    if(!$errors){
                        $messages[] = '登録が完了しました';
                        $params = [];
                    }
                }catch (\Exception $e){
                    $errors[] = '登録中にエラーが発生しました';
                }

            } else if(isset($params['elements_id_selected'])){
                $elements_list_selected = [];

                $elements_list_selected['elements_id_selected'] = $params['elements_id_selected'];
                $elements_list_selected['amount_selected'] = $params['amount_selected'];

                $cocktail = new Cocktails($elements_list_selected);
                $new_elements_list = $cocktail->makeElementsList();

                $this->set('elements_list_selected', $new_elements_list);
            }
        }

        $this->set('errors', $errors);
        $this->set('messages', $messages);
        $this->set('params', $params);
        $this->set('results', $results);
    }

    /**
     * (Ajax用)エレメントのプルダウン制御用
     * GET /getElementsOptions/:id
     * @param $category_kbn
     */
    public function getElementsOptions($category_kbn)
    {
        if (!$this->request->is('ajax')) {
            $this->redirect('/');
        }

        $cocktails = new Cocktails();
        $elements_list = $cocktails->getElementsList($category_kbn);

        $this->set('elements_list', $elements_list);
        $this->render('/Element/cocktails/ajax_elements_options','');
    }

    /**
     * (Ajax用)選択済み材料追加用
     * POST /mergeElementsTable
     */
    public function mergeElementsTable()
    {
        if (!$this->request->is('ajax')) {
            $this->redirect('/');
        }

        // 追加されている材料 elements_id_selected[], amount_selected[]
        // 追加される材料 elements_id, amount
        $params = $this->request->getData();
        $elements_list_selected = [];

        // 追加されている材料リストに、追加される材料を追加
        if(isset($params['elements_id_selected'])){
            $elements_list_selected['elements_id_selected'] = $params['elements_id_selected'];
            $elements_list_selected['amount_selected'] = $params['amount_selected'];
        }
        $elements_list_selected['elements_id_selected'][] = $params['elements_id'];
        $elements_list_selected['amount_selected'][] = $params['amount'];

        $cocktail = new Cocktails($elements_list_selected);
        $new_elements_list = $cocktail->makeElementsList();

        $this->set('elements_list_selected', $new_elements_list);
        $this->render('/Element/cocktails/ajax_elements_table','');
    }

    /**
     * (Ajax用)選択済み材料削除用
     * POST /deleteElementsTable
     */
    public function deleteElementsTable(){

        if (!$this->request->is('ajax')) {
            $this->redirect('/');
        }

        // 追加されている材料 elements_id_selected[], amount_selected[]
        // 削除される材料 elements_id
        $params = $this->request->getData();
        $elements_list_selected = [];

        // 追加されている材料リストから、削除される材料を削除
        $elements_list_selected['elements_id_selected'] = $params['elements_id_selected'];
        $elements_list_selected['amount_selected'] = $params['amount_selected'];
        array_splice($elements_list_selected['elements_id_selected'], $params['del_index'], 1);
        array_splice($elements_list_selected['amount_selected'], $params['del_index'], 1);

        $cocktail = new Cocktails($elements_list_selected);
        $new_elements_list = $cocktail->makeElementsList();

        $this->set('elements_list_selected', $new_elements_list);
        $this->render('/Element/cocktails/ajax_elements_table','');
    }
}