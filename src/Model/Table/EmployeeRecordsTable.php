<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmployeeRecords Model
 *
 * @method \App\Model\Entity\EmployeeRecord newEmptyEntity()
 * @method \App\Model\Entity\EmployeeRecord newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeRecord[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeRecord get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmployeeRecord findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\EmployeeRecord patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeRecord[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeRecord|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeeRecord saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeeRecord[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmployeeRecord[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmployeeRecord[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmployeeRecord[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployeeRecordsTable extends Table
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

        $this->setTable('employee_records');
        $this->setDisplayField('start');
        $this->setPrimaryKey('id');

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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('employee_person_doc_type')
            ->allowEmptyString('employee_person_doc_type', null, 'create');

        $validator
            ->scalar('employee_person_doc_num')
            ->maxLength('employee_person_doc_num', 10)
            ->allowEmptyString('employee_person_doc_num', null, 'create');

        $validator
            ->date('start')
            ->requirePresence('start', 'create')
            ->notEmptyDate('start');

        $validator
            ->date('end')
            ->allowEmptyDate('end');

        return $validator;
    }

    /**
     * Find Last employee.
     *
     * @param \Cake\ORM\Query $query Query instance.
     * @param array $options Options.
     * @return \Cake\ORM\Query
     */
    public function findLast(Query $query, array $options): Query
    {
        return $query
            ->order(['EmployeeRecords.start' => 'DESC'])
            ->limit(1);
    }
}
