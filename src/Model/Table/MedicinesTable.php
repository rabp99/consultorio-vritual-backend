<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Medicines Model
 *
 * @property \App\Model\Table\RecipeDetailsTable&\Cake\ORM\Association\HasMany $RecipeDetails
 * @method \App\Model\Entity\Medicine newEmptyEntity()
 * @method \App\Model\Entity\Medicine newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Medicine[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Medicine get($primaryKey, $options = [])
 * @method \App\Model\Entity\Medicine findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Medicine patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Medicine[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Medicine|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Medicine saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Medicine[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Medicine[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Medicine[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Medicine[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MedicinesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('medicines');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('RecipeDetails', [
            'foreignKey' => 'medicine_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('description')
            ->maxLength('description', 150)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('presentation')
            ->maxLength('presentation', 60)
            ->allowEmptyString('presentation');

        $validator
            ->scalar('state')
            ->requirePresence('state', 'create')
            ->notEmptyString('state');

        return $validator;
    }
}
