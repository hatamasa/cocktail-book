<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class MstElement extends Entity
{
    public function initialize(array $config){
        $this->hasMany('CocktailElements')
        ->setForeignKey('id');
    }

}