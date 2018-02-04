<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CocktailsElements Model
 *
 * @property \App\Model\Table\CocktailsTable|\Cake\ORM\Association\BelongsTo $Cocktails
 * @property \App\Model\Table\ElementsTable|\Cake\ORM\Association\BelongsTo $Elements
 *
 * @method \App\Model\Entity\CocktailsElement get($primaryKey, $options = [])
 * @method \App\Model\Entity\CocktailsElement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CocktailsElement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CocktailsElement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CocktailsElement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CocktailsElement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CocktailsElement findOrCreate($search, callable $callback = null, $options = [])
 */
class CocktailsElementsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('cocktails_elements');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Cocktails', [
            'foreignKey' => 'cocktail_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Elements', [
            'foreignKey' => 'element_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('amount')
            ->maxLength('amount', 20)
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->dateTime('dt_create')
            ->allowEmpty('dt_create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['cocktail_id'], 'Cocktails'));
        $rules->add($rules->existsIn(['element_id'], 'Elements'));

        return $rules;
    }

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
