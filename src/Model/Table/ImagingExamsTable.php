<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ImagingExams Model
 *
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\BelongsToMany $Appointments
 *
 * @method \App\Model\Entity\ImagingExam newEmptyEntity()
 * @method \App\Model\Entity\ImagingExam newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ImagingExam[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ImagingExam get($primaryKey, $options = [])
 * @method \App\Model\Entity\ImagingExam findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ImagingExam patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ImagingExam[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ImagingExam|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ImagingExam saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ImagingExam[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ImagingExam[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ImagingExam[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ImagingExam[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ImagingExamsTable extends Table
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

        $this->setTable('imaging_exams');
        $this->setDisplayField('description');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Appointments', [
            'foreignKey' => 'imaging_exam_id',
            'targetForeignKey' => 'appointment_id',
            'joinTable' => 'appointments_imaging_exams',
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
            ->maxLength('description', 60)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('state')
            ->notEmptyString('state');

        return $validator;
    }
}
