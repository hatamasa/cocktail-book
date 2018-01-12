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
        $errors = [];
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
     * GET|POST /create
     */
    public function create()
    {
        $errors = [];
        $messages = [];
        $params = [];
        $results = [];
        $params = $this->request->getData();

        if ($this->request->is('get')){
            // 表示時は空で遷移
            $this->render();
        } else if($this->request->is('post')){
            // 登録時処理
            $cocktails = new Cocktails($params);
            $errors = $cocktails->valudateForCreate();

            if(! $errors){
                try{
                    $results = $cocktails->createCocktail();
                    $messages[] = '登録が完了しました';
                    $params = [];
                }catch (\Exception $e){
                    $messages[] = '登録中にエラーが発生しました';
                }
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
     * (Ajax用)選択済み材料制御用
     * POST /mergeElementsTable
     * @param $params
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
        echo("<pre>");
        var_dump($new_elements_list);
        echo("</pre>");

        $this->set('elements_list_selected', $new_elements_list);
        $this->render('/Element/cocktails/ajax_elements_table','');
    }
}