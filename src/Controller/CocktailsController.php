<?php
namespace App\Controller;

use App\Model\Cocktails\Cocktails;
use WyriHaximus\TwigView\Lib\Twig\Node\Element;

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
     * GET /getElementOptions/:id
     * @param $category_kbn
     */
    public function getElementOptions($category_kbn)
    {
        if (!$this->request->is('ajax')) {
            $this->redirect('/');
        }

        $cocktails = new Cocktails();
        $element_list = $cocktails->getElementList($category_kbn);

        $this->set('element_list', $element_list);
        $this->render('/Element/cocktails/ajax_element_options','');
    }

    /**
     * (Ajax用)選択済み材料制御用
     * POST /mergeElementTable
     * @param $params
     */
    public function mergeElementTable()
    {
        if (!$this->request->is('ajax')) {
            $this->redirect('/');
        }

        $params = $this->request->getData();
        $cocktail = new Cocktails($params);
        $elements = $cocktail->getElementsById();
        $element_list_selected = [];

        // すでに選択している材料＋追加した材料
        $element_list_selected[] = [
            'category_kbn' => $params['category_kbn'],
            'elements_id' => $params['elements_id'],
            'name' => $elements['name'],
            'amount' => $params['amount'],
        ];

        // TODO 追加済みの材料に追加する方法を検討する
        $this->set('element_list_selected', $element_list_selected);
        $this->render('/Element/cocktails/ajax_element_table','');
    }
}