<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AppointmentsImagingExams Model
 *
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\BelongsTo $Appointments
 * @property \App\Model\Table\ImagingExamsTable&\Cake\ORM\Association\BelongsTo $ImagingExams
 *
 * @method \App\Model\Entity\AppointmentsImagingExam newEmptyEntity()
 * @method \App\Model\Entity\AppointmentsImagingExam newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentsImagingExam[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentsImagingExam get($primaryKey, $options = [])
 * @method \App\Model\Entity\AppointmentsImagingExam findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AppointmentsImagingExam patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentsImagingExam[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentsImagingExam|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AppointmentsImagingExam saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AppointmentsImagingExam[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppointmentsImagingExam[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppointmentsImagingExam[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppointmentsImagingExam[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AppointmentsImagingExamsTable extends Table
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

        $this->setTable('appointments_imaging_exams');
        $this->setDisplayField('appointment_id');
        $this->setPrimaryKey(['appointment_id', 'imaging_exam_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Appointments', [
            'foreignKey' => 'appointment_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ImagingExams', [
            'foreignKey' => 'imaging_exam_id',
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
        $rules->add($rules->existsIn(['imaging_exam_id'], 'ImagingExams'), ['errorField' => 'imaging_exam_id']);

        return $rules;
    }
}
