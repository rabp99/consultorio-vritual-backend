<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ConsultingRoom Entity
 *
 * @property int $id
 * @property string $description
 * @property string|null $floor
 * @property int $place_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string $state
 *
 * @property \App\Model\Entity\Place $place
 * @property \App\Model\Entity\Appointment[] $appointments
 */
class ConsultingRoom extends Entity
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
        'description' => true,
        'floor' => true,
        'place_id' => true,
        'created' => true,
        'modified' => true,
        'state' => true,
        'place' => true,
        'appointments' => true,
    ];
}
