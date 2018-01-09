<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class CocktailElement extends Entity
{
    public function initialize(array $config){
        $this->belongsTo('MstElements')
        ->setForeignKey('element_id');
    }

}