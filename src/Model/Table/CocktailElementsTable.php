<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CocktailElementsTable extends Table
{

    public function fetchElementsByCocktailId($cocktails_id){

        $query = $this->query();

        $query
            ->select([
                'saved_id' => 'CocktailElements.id',
                'id' => 'me.id',
                'amount' => 'CocktailElements.amount',
                'category_kbn' => 'me.category_kbn',
                'name' => 'me.name'
            ])
            ->innerJoin(['me' => 'elements'], ['CocktailElements.elements_id = me.id'])
            ->where(['CocktailElements.cocktails_id' => $cocktails_id])
            ->order(['me.category_kbn' => 'ASC'])
            ->order(['CocktailElements.elements_id' => 'ASC']);

        return $query->toArray();
    }
}