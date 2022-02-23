<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AppointmentsLaboratoryExams Model
 *
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\BelongsTo $Appointments
 * @property \App\Model\Table\LaboratoryExamsTable&\Cake\ORM\Association\BelongsTo $LaboratoryExams
 *
 * @method \App\Model\Entity\AppointmentsLaboratoryExam newEmptyEntity()
 * @method \App\Model\Entity\AppointmentsLaboratoryExam newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentsLaboratoryExam[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentsLaboratoryExam get($primaryKey, $options = [])
 * @method \App\Model\Entity\AppointmentsLaboratoryExam findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AppointmentsLaboratoryExam patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentsLaboratoryExam[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentsLaboratoryExam|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AppointmentsLaboratoryExam saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AppointmentsLaboratoryExam[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppointmentsLaboratoryExam[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppointmentsLaboratoryExam[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppointmentsLaboratoryExam[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AppointmentsLaboratoryExamsTable extends Table
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

        $this->setTable('appointments_laboratory_exams');
        $this->setDisplayField('appointment_id');
        $this->setPrimaryKey(['appointment_id', 'laboratory_exam_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Appointments', [
            'foreignKey' => 'appointment_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('LaboratoryExams', [
            'foreignKey' => 'laboratory_exam_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn(['appointment_id'], 'Appointments'), ['errorField' => 'appointment_id']);
        $rules->add($rules->existsIn(['laboratory_exam_id'], 'LaboratoryExams'), ['errorField' => 'laboratory_exam_id']);

        return $rules;
    }
}
