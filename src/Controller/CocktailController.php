<?php
namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use App\Model\Cocktail\CocktailSearch;

class CocktailController extends AppController
{

    /**
     *
     * @param $param
     */
    public function search()
    {
        $conn = ConnectionManager::get('dev');
        $params = $this->request->params;

        $cocktailQuery = new CocktailSearch($conn, $params);

        $results = $cocktailQuery->fetchCocktailByKeyword();

        $this->set('results', $results);
    }
}