<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CocktailsElement Entity
 *
 * @property int $id
 * @property int $cocktail_id
 * @property int $element_id
 * @property string $amount
 * @property \Cake\I18n\FrozenTime $dt_create
 *
 * @property \App\Model\Entity\Cocktail $cocktail
 * @property \App\Model\Entity\Element $element
 */
class CocktailsElement extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'cocktail_id' => true,
        'element_id' => true,
        'amount' => true,
        'dt_create' => true,
        'cocktail' => true,
        'element' => true
    ];
}
