<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Recipe Entity
 *
 * @property int $id
 * @property int $appointment_id
 * @property int $medicine_id
 * @property int $amount
 * @property int|null $days
 * @property string $prescription
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Appointment $appointment
 * @property \App\Model\Entity\Medicine $medicine
 */
class Recipe extends Entity
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
        'appointment_id' => true,
        'medicine_id' => true,
        'amount' => true,
        'days' => true,
        'prescription' => true,
        'created' => true,
        'modified' => true,

        'appointment' => true,
        'medicine' => true,
    ];
}
