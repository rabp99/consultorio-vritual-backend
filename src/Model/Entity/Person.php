<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Person Entity
 *
 * @property string $doc_type
 * @property string $doc_num
 * @property string $names
 * @property string $last_name1
 * @property string $last_name2
 * @property \Cake\I18n\FrozenDate $birth
 * @property string $nationality
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string $gendre
 * @property array|null $tels
 */
class Person extends Entity
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
        'doc_type' => true,
        'doc_num' => true,
        'names' => true,
        'last_name1' => true,
        'last_name2' => true,
        'birth' => true,
        'nationality' => true,
        'created' => true,
        'modified' => true,
        'gendre' => true,
        'tels' => true,
    ];
    
    protected $_virtual = ['full_name'];
    
    protected function _getFullName(): string {
        return $this->last_name1 . ' ' . $this->last_name2 . ', ' . $this->names;
    }
}
