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
 * @property string|null $cost
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string $state
 *
 * @property \App\Model\Entity\ConsultingRoom $consulting_room
 * @property \App\Model\Entity\Diagnostic[] $diagnostics
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
     * @var array
     */
    protected $_accessible = [
        'patient_person_doc_type' => true,
        'patient_person_doc_num' => true,
        'employee_person_doc_type' => true,
        'employee_person_doc_num' => true,
        'consulting_room_id' => true,
        'appointment_date' => true,
        'cost' => true,
        'created' => true,
        'modified' => true,
        'state' => true,
        'consulting_room' => true,
        'diagnostics' => true,
        'recipes' => true,
    ];
}
