<?php
namespace App\Controller;

use App\Model\Cocktails\Cocktails;
use Symfony\Component\VarDumper\Tests\Fixture\DumbFoo;
use App\Model\Table\ElementsTable;

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
     * エレメントのプルダウン制御用
     * @param $category_kbn
     * GET /getElementsOptions/:id
     */
    public function getElementsOptions($category_kbn)
    {
        $cocktails = new Cocktails();
        $elements_options = $cocktails->getElementsOptions($category_kbn);

        $this->set('elements_options', $elements_options);
        $this->layout = false;
    }
}