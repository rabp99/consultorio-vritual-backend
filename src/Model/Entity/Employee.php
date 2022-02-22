<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property string $person_doc_type
 * @property string $person_doc_num
 * @property string|null $cmp
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string $state
 *
 * @property \App\Model\Entity\Person $person
 * @property \App\Model\Entity\EmployeeRecord[] $employee_records
 * @property \App\Model\Entity\EmployeeRecord $last_employee_record
 */
class Employee extends Entity
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
        'cmp' => true,
        'created' => true,
        'modified' => true,
        'state' => true,

        'person' => true,
        'employee_records' => true,
        'last_employee_record' => true,
    ];
}
