<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Appointments Model
 *
 * @property \App\Model\Table\ConsultingRoomsTable&\Cake\ORM\Association\BelongsTo $ConsultingRooms
 * @property \App\Model\Table\DiagnosticsTable&\Cake\ORM\Association\HasMany $Diagnostics
 * @property \App\Model\Table\RecipesTable&\Cake\ORM\Association\HasMany $Recipes
 * 
 * @method \App\Model\Entity\Appointment newEmptyEntity()
 * @method \App\Model\Entity\Appointment newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Appointment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Appointment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Appointment findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Appointment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Appointment[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Appointment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Appointment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Appointment[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Appointment[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Appointment[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Appointment[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AppointmentsTable extends Table
{
    private const PENDIENTE = 'PENDIENTE';
    private const TERMINADA = 'TERMINADA';
    private const REPROGRAMADA = 'REPROGRAMADA';
    private const CANCELADA = 'CANCELADA';

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('appointments');
        $this->setDisplayField('appointment_date');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Userstamp');

        $this->hasOne('Citts');
        
        $this->belongsTo('ConsultingRooms')
            ->setForeignKey('consulting_room_id')
            ->setJoinType('INNER');
        
        $this->belongsTo('Creator')
            ->setForeignKey('user_creator')
            ->setJoinType('INNER')
            ->setClassName('Users');
        
        $this->hasMany('Diagnostics')
            ->setForeignKey('appointment_id');
        
        $this->belongsToMany(
            'Diseases',
            ['joinTable' => 'diagnostics'])
            ->setForeignKey('appointment_id')
            ->setTargetForeignKey('disease_id');
        
        $this->belongsTo('Employees')
            ->setForeignKey(['employee_person_doc_type', 'employee_person_doc_num'])
            ->setJoinType('INNER');
        
        $this->belongsToMany('ImagingExams');
        
        $this->belongsToMany('LaboratoryExams');
        
        $this->belongsTo('Modifier')
            ->setForeignKey('user_modifier')
            ->setJoinType('INNER')
            ->setClassName('Users');
        
        $this->belongsTo('Patients')
            ->setForeignKey(['patient_person_doc_type', 'patient_person_doc_num'])
            ->setJoinType('INNER');
        
        $this->hasMany('Recipes')
            ->setForeignKey('appointment_id');
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
            ->allowEmptyString('id', null, 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('patient_person_doc_type')
            ->requirePresence('patient_person_doc_type', 'create')
            ->notEmptyString('patient_person_doc_type');

        $validator
            ->scalar('patient_person_doc_num')
            ->maxLength('patient_person_doc_num', 10)
            ->requirePresence('patient_person_doc_num', 'create')
            ->notEmptyString('patient_person_doc_num');

        $validator
            ->scalar('employee_person_doc_type')
            ->requirePresence('employee_person_doc_type', 'create')
            ->notEmptyString('employee_person_doc_type');

        $validator
            ->scalar('employee_person_doc_num')
            ->maxLength('employee_person_doc_num', 10)
            ->requirePresence('employee_person_doc_num', 'create')
            ->notEmptyString('employee_person_doc_num');

        $validator
            ->dateTime('appointment_date')
            ->requirePresence('appointment_date', 'create')
            ->notEmptyDateTime('appointment_date');

        $validator
            ->dateTime('cancel_date')
            ->allowEmptyDateTime('cancel_date');

        $validator
            ->decimal('cost')
            ->allowEmptyString('cost');

        $validator
            ->naturalNumber('systolic_blood_pressure')
            ->allowEmptyString('systolic_blood_pressure');

        $validator
            ->naturalNumber('diastolic_blood_pressure')
            ->allowEmptyString('diastolic_blood_pressure');
        
        $validator
            ->decimal('weight')
            ->allowEmptyString('weight');
        
        $validator
            ->decimal('height')
            ->allowEmptyString('height');
        
        $validator
            ->scalar('comment')
            ->allowEmptyString('comment');
        
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
        $rules->add($rules->isUnique(['id']), ['errorField' => 'id']);
        $rules->add(
            $rules->existsIn(
                ['consulting_room_id'],
                'ConsultingRooms'
            ),
            ['errorField' => 'consulting_room_id']
        );
        $rules->add($rules->existsIn(['user_created'], 'Creator'), ['errorField' => 'user_created']);

        return $rules;
    }

    /**
     * Cancel.
     *
     * @param \App\Model\Entity\Appointment &$appointment Appointment instance.
     * @return bool
     */
    public function cancel(\App\Model\Entity\Appointment &$appointment): bool
    {
        $appointment->state = self::CANCELADA;
        $appointment->cancel_date = FrozenTime::now();

        return (bool)$this->save($appointment);
    }

    /**
     * Undo Cancel.
     *
     * @param \App\Model\Entity\Appointment &$appointment Appointment instance.
     * @return bool
     */
    public function undoCancel(\App\Model\Entity\Appointment &$appointment): bool
    {
        $appointment->state = self::PENDIENTE;
        $appointment->cancel_date = null;

        return (bool)$this->save($appointment);
    }

    /**
     * Reschedule.
     *
     * @param \App\Model\Entity\Appointment &$appointment Appointment instance.
     * @return bool
     */
    public function reschedule(\App\Model\Entity\Appointment &$appointment): bool
    {
        $appointment->setAccess('consulting_room', false);
        $appointment->state = self::REPROGRAMADA;

        return (bool)$this->save($appointment);
    }

    /**
     * Attend.
     *
     * @param \App\Model\Entity\Appointment &$appointment Appointment instance.
     * @return bool
     */
    public function attend(\App\Model\Entity\Appointment &$appointment): bool
    {
        $appointment->state = self::TERMINADA;

        return (bool)$this->save($appointment);
    }

    /**
     * Find By Patient.
     *
     * @param \Cake\ORM\Query $query Query instance.
     * @param array $options Options.
     * @return \Cake\ORM\Query
     */
    public function findByPatient(Query $query, array $options): Query
    {
        $patient_person_doc_type = $options['patient_person_doc_type'];
        $patient_person_doc_num = $options['patient_person_doc_num'];

        return $query
            ->select(['id', 'appointment_date'])
            ->where([
                'patient_person_doc_type' => $patient_person_doc_type,
                'patient_person_doc_num' => $patient_person_doc_num,
                'state' => self::TERMINADA,
            ])
            ->order(['appointment_date' => 'DESC']);
    }
}
