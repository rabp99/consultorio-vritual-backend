<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\I18n\FrozenDate;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @property \App\Model\Table\EmployeeRecordsTable $EmployeeRecords
 * @property \App\Model\Table\PeopleTable $People
 * @method \App\Model\Entity\Employee newEmptyEntity()
 * @method \App\Model\Entity\Employee newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployeesTable extends Table
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

        $this->setTable('employees');
        $this->setDisplayField('person_doc_type');
        $this->setPrimaryKey(['person_doc_type', 'person_doc_num']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('EmployeePerson')
            ->setForeignKey(['person_doc_type', 'person_doc_num'])
            ->setJoinType('INNER')
            ->setClassName('People');

        $this->hasMany('EmployeeRecords', [
            'foreignKey' => ['employee_person_doc_type', 'employee_person_doc_num'],
        ]);
        $this->hasOne('LastEmployeeRecord')
            ->setForeignKey(['employee_person_doc_type', 'employee_person_doc_num'])
            ->setClassName('EmployeeRecords')
            ->setFinder('last');

        $this->belongsTo('People')
            ->setForeignKey(['person_doc_type', 'person_doc_num'])
            ->setJoinType('INNER');
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
            ->scalar('person_doc_type')
            ->allowEmptyString('person_doc_type', null, 'create');

        $validator
            ->scalar('person_doc_num')
            ->maxLength('person_doc_num', 10)
            ->allowEmptyString('person_doc_num', null, 'create');

        $validator
            ->scalar('cmp')
            ->maxLength('cmp', 6)
            ->allowEmptyString('cmp')
            ->add('cmp', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('state')
            ->requirePresence('state', 'create')
            ->notEmptyString('state');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['cmp']), ['errorField' => 'cmp']);
        $rules->add(function ($entity, $options) {
            if (!$entity->last_employee_record) {
                return true;
            }
            if (!$entity->employee_records) {
                return true;
            }

            if ($entity->employee_records[0]->start < $entity->last_employee_record->end) {
                return false;
            }

            return true;
        }, 'startOufOfDate',
        [
            'errorField' => 'start',
            'message' => __('La fecha de inicio es inferior a la última fecha final registrada'),
        ]);
        $rules->add(function ($entity, $options) {
            if (!$entity->last_employee_record) {
                return true;
            }

            if (!$entity->employee_records) {
                return true;
            }

            if ($entity->employee_records[0]->end === null) {
                return true;
            }

            if ($entity->employee_records[0]->end < $entity->last_employee_record->start) {
                return false;
            }

            return true;
        }, 'endOufOfDate',
        [
            'errorField' => 'end',
            'message' => __('La fecha final es inferior a la fecha de inicio registrada'),
        ]);

        return $rules;
    }

    /**
     * Enable employee.
     *
     * @param \App\Model\Entity\Employee &$employee Employee instance.
     * @param \Cake\I18n\FrozenDate $start Start Date.
     * @return bool
     */
    public function enable(\App\Model\Entity\Employee &$employee, FrozenDate $start): bool
    {
        $employee->state = 'ACTIVO';
        $lastEmployeeRecord = $this->EmployeeRecords->newEmptyEntity();
        $lastEmployeeRecord->start = new FrozenDate($start);
        $employee->employee_records = [$lastEmployeeRecord];
        if ($this->save($employee)) {
            return true;
        }

        return false;
    }

    /**
     * Disable employee.
     *
     * @param \App\Model\Entity\Employee &$employee Employee instance.
     * @param \Cake\I18n\FrozenDate $end End Date.
     * @return bool
     */
    public function disable(\App\Model\Entity\Employee &$employee, $end): bool
    {
        $employee->state = 'INACTIVO';
        $employeeRecord = $this->EmployeeRecords->get($employee->last_employee_record->get('id'));
        $employeeRecord->end = new FrozenDate($end);
        $employee->employee_records = [$employeeRecord];
        if ($this->save($employee)) {
            return true;
        }

        return false;
    }
}
