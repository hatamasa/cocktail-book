<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Cocktail extends Entity
{
    public function initialize(array $config){
        $this->hasMany('CocktailElements')
            ->setForeignKey('cocktail_id');
    }

}