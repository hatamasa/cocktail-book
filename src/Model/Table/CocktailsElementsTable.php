<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CocktailsElementsTable extends Table
{

    public function fetchElementsByCocktailId($cocktail_id){

        $query = $this->query();

        $query
            ->select([
                'saved_id' => 'CocktailsElements.id',
                'id' => 'me.id',
                'amount' => 'CocktailsElements.amount',
                'category_kbn' => 'me.category_kbn',
                'name' => 'me.name'
            ])
            ->innerJoin(['me' => 'elements'], ['CocktailsElements.element_id = me.id'])
            ->where(['CocktailsElements.cocktail_id' => $cocktail_id])
            ->order(['me.category_kbn' => 'ASC'])
            ->order(['CocktailsElements.element_id' => 'ASC']);

        return $query->toArray();
    }
}