<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ElementsTable extends Table
{

    public function initialize(array $config)
    {
        $this->hasMany('CocktailsElements')
            ->setForeignKey('element_id');
    }
}