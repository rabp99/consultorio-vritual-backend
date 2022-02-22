<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Patients Model
 *
 * @method \App\Model\Entity\Patient newEmptyEntity()
 * @method \App\Model\Entity\Patient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Patient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Patient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Patient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Patient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Patient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Patient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Patient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PatientsTable extends Table
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

        $this->setTable('patients');
        $this->setDisplayField('person_doc_type');
        $this->setPrimaryKey(['person_doc_type', 'person_doc_num']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('PatientPerson')
            ->setForeignKey(['person_doc_type', 'person_doc_num'])
            ->setJoinType('INNER')
            ->setClassName('People');

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
            ->scalar('state')
            ->requirePresence('state', 'create')
            ->notEmptyString('state');

        return $validator;
    }

    /**
     * Enable patient.
     *
     * @param \App\Model\Entity\Patient &$patient Patient instance.
     * @return bool
     */
    public function enable(\App\Model\Entity\Patient &$patient): bool
    {
        $patient->state = 'ACTIVO';

        return (bool)$this->save($patient);
    }

    /**
     * Disable patient.
     *
     * @param \App\Model\Entity\Patient &$patient Patient instance.
     * @return bool
     */
    public function disable(\App\Model\Entity\Patient &$patient): bool
    {
        $patient->state = 'INACTIVO';

        return (bool)$this->save($patient);
    }
}
