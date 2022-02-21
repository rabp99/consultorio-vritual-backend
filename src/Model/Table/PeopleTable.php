<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * People Model
 *
 * @method \App\Model\Entity\Person newEmptyEntity()
 * @method \App\Model\Entity\Person newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Person[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Person get($primaryKey, $options = [])
 * @method \App\Model\Entity\Person findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Person patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Person[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Person|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Person saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PeopleTable extends Table
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

        $this->setTable('people');
        $this->setDisplayField('doc_type');
        $this->setPrimaryKey(['doc_type', 'doc_num']);

        $this->addBehavior('Timestamp');
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
            ->scalar('doc_type')
            ->allowEmptyString('doc_type', null, 'create');

        $validator
            ->scalar('doc_num')
            ->maxLength('doc_num', 10)
            ->allowEmptyString('doc_num', null, 'create');

        $validator
            ->scalar('names')
            ->maxLength('names', 90)
            ->requirePresence('names', 'create')
            ->notEmptyString('names');

        $validator
            ->scalar('last_name1')
            ->maxLength('last_name1', 60)
            ->requirePresence('last_name1', 'create')
            ->notEmptyString('last_name1');

        $validator
            ->scalar('last_name2')
            ->maxLength('last_name2', 60)
            ->requirePresence('last_name2', 'create')
            ->notEmptyString('last_name2');

        $validator
            ->date('birth')
            ->requirePresence('birth', 'create')
            ->notEmptyDate('birth');

        $validator
            ->scalar('nationality')
            ->maxLength('nationality', 90)
            ->requirePresence('nationality', 'create')
            ->notEmptyString('nationality');

        $validator
            ->scalar('gendre')
            ->requirePresence('gendre', 'create')
            ->notEmptyString('gendre');

        $validator
            ->allowEmptyString('tels');

        return $validator;
    }
}
