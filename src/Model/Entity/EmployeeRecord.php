<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmployeeRecord Entity
 *
 * @property int $id
 * @property string $employee_person_doc_type
 * @property string $employee_person_doc_num
 * @property \Cake\I18n\FrozenDate $start
 * @property \Cake\I18n\FrozenDate|null $end
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class EmployeeRecord extends Entity
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
        'start' => true,
        'end' => true,
        'created' => true,
        'modified' => true,
    ];
}
