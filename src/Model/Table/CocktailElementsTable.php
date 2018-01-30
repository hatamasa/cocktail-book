<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CocktailElementsTable extends Table
{

    public function fetchElementsByCocktailId($cocktail_id){

        $query = $this->query();

        $query
            ->select([
                'saved_id' => 'CocktailElements.id',
                'id' => 'me.id',
                'amount' => 'CocktailElements.amount',
                'category_kbn' => 'me.category_kbn',
                'name' => 'me.name'
            ])
            ->innerJoin(['me' => 'elements'], ['CocktailElements.element_id = me.id'])
            ->where(['CocktailElements.cocktail_id' => $cocktail_id])
            ->order(['me.category_kbn' => 'ASC'])
            ->order(['CocktailElements.element_id' => 'ASC']);

        return $query->toArray();
    }
}