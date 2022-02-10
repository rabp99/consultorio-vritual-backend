<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property string $username
 * @property string|null $email
 * @property string $password
 * @property string $role
 * @property string $employee_person_doc_type
 * @property string $employee_person_doc_num
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string $state
 */
class User extends Entity
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
        'username' => true,
        'email' => true,
        'password' => true,
        'role' => true,
        'employee_person_doc_type' => true,
        'employee_person_doc_num' => true,
        'created' => true,
        'modified' => true,
        'state' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
    
    protected function _setPassword(string $password) {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }
}
