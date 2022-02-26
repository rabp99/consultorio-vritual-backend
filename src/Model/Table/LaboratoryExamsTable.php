<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LaboratoryExams Model
 *
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\BelongsToMany $Appointments
 *
 * @method \App\Model\Entity\LaboratoryExam newEmptyEntity()
 * @method \App\Model\Entity\LaboratoryExam newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LaboratoryExam[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LaboratoryExam get($primaryKey, $options = [])
 * @method \App\Model\Entity\LaboratoryExam findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LaboratoryExam patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LaboratoryExam[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LaboratoryExam|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LaboratoryExam saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LaboratoryExam[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LaboratoryExam[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LaboratoryExam[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LaboratoryExam[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LaboratoryExamsTable extends Table
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

        $this->setTable('laboratory_exams');
        $this->setDisplayField('id');
        $this->setPrimaryKey('description');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Appointments', [
            'foreignKey' => 'laboratory_exam_id',
            'targetForeignKey' => 'appointment_id',
            'joinTable' => 'appointments_laboratory_exams',
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
