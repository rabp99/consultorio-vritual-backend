<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Appointment Entity
 *
 * @property int $id
 * @property string $patient_person_doc_type
 * @property string $patient_person_doc_num
 * @property string $employee_person_doc_type
 * @property string $employee_person_doc_num
 * @property int $consulting_room_id
 * @property \Cake\I18n\FrozenTime $appointment_date
 * @property \Cake\I18n\FrozenTime|null $cancel_date
 * @property string|null $cost
 * @property int|null $systolic_blood_pressure
 * @property int|null $diastolic_blood_pressure
 * @property float|null $weight
 * @property float|null $height
 * @property string|null $comment
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string $state
 * @property string $user_created
 * @property string|null $user_modified
 *
 * @property \App\Model\Entity\Citt $citt
 * @property \App\Model\Entity\ConsultingRoom $consulting_room
 * @property \App\Model\Entity\User $creator
 * @property \App\Model\Entity\Diagnostic[] $diagnostics
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\ImagingExam[] $imaging_exams
 * @property \App\Model\Entity\LaboratoryExam[] $laboratory_exams
 * @property \App\Model\Entity\User $modifier
 * @property \App\Model\Entity\Patient $patient
 * @property \App\Model\Entity\Recipe[] $recipes
 */
class Appointment extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'patient_person_doc_type' => true,
        'patient_person_doc_num' => true,
        'employee_person_doc_type' => true,
        'employee_person_doc_num' => true,
        'consulting_room_id' => true,
        'appointment_date' => true,
        'cancel_date' => true,
        'cost' => true,
        'systolic_blood_pressure' => true,
        'diastolic_blood_pressure' => true,
        'weight' => true,
        'height' => true,
        'comment' => true,
        'created' => true,
        'modified' => true,
        'state' => true,
        'user_created' => true,
        'user_modified' => true,

        'citt' => true,
        'consulting_room' => true,
        'creator' => true,
        'diagnostics' => true,
        'employee' => true,
        'imaging_exams' => true,
        'laboratory_exams' => true,
        'modifier' => true,
        'patient' => true,
        'recipes' => true,
    ];
}
