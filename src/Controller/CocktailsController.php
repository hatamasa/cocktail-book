<?php
namespace App\Controller;

use App\Model\Cocktails\Cocktails;

class CocktailsController extends AppController
{

    /**
     * 初期表示
     */
    public function index()
    {
        $this->render('search');
    }

    /**
     * カクテル検索
     * @param　$param
     */
    public function search()
    {
        $results = [];
        $errors = [];
        $messages = [];
        $params = $this->request->getQueryParams();

        $cocktails = new Cocktails($params);
        $errors = $cocktails->validate();

        if (! $errors) {
            $results = $this->Cocktails->searchCocktails($params);

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
}