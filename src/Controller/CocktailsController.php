<?php
namespace App\Controller;

class CocktailsController extends AppController
{

    /**
     * カクテル検索
     * @param $param
     */
    public function search()
    {
        $params = $this->request->getQueryParams();

        $results = $this->Cocktails->searchCocktails($params);

        $this->set('results', $results);
    }
}