<?php
namespace App\Controller;

use App\Model\Cocktail\CocktailSearch;

class CocktailsController extends AppController
{

    /**
     * カクテル検索
     * @param $param
     */
    public function search()
    {
        $params = $this->request->getQueryParams();

        $cocktailQuery = new CocktailSearch($params);

        $results = $cocktailQuery->fetchCocktailByKeyword();

        $this->set('results', $results);
    }
}