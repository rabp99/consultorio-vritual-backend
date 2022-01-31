<?php
declare(strict_types=1);

namespace App\Model\Table;

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
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AppointmentsTable extends Table
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

        $this->setTable('appointments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ConsultingRooms', [
            'foreignKey' => 'consulting_room_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Diagnostics', [
            'foreignKey' => 'appointment_id',
        ]);
        $this->hasMany('Recipes', [
            'foreignKey' => 'appointment_id',
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
            ->decimal('cost')
            ->allowEmptyString('cost');

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
        $rules->add($rules->existsIn(['consulting_room_id'], 'ConsultingRooms'), ['errorField' => 'consulting_room_id']);

        return $rules;
    }
}
