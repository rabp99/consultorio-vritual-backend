<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AppointmentsLaboratoryExam Entity
 *
 * @property int $appointment_id
 * @property int $laboratory_exam_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Appointment $appointment
 * @property \App\Model\Entity\LaboratoryExam $laboratory_exam
 */
class AppointmentsLaboratoryExam extends Entity
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
        'created' => true,
        'modified' => true,
        'appointment' => true,
        'laboratory_exam' => true,
    ];
}
