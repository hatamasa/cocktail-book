<?php
namespace App\Controller;

use App\Model\Cocktails\Cocktails;
use Symfony\Component\VarDumper\Tests\Fixture\DumbFoo;

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

        if ($this->request->is('get')){
            return ;
        }

        if($this->request->is('post')){

            $params = $this->request->getData();

            $cocktails = new Cocktails($params);
            $errors = $cocktails->valudateForCreate();

            if(! $errors){
                try{
                    $cocktails->createCocktail();
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
    }
}