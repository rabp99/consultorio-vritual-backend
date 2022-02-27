<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\I18n\FrozenDate;
use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    public $import = ['table' => 'users'];

    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $hasher = new DefaultPasswordHasher();
        $password = $hasher->hash('70801887');
        $this->records = [
            [
                'username' => '70801887',
                'email' => 'rabp_91@hotmail.com',
                'password' => $password,
                'role' => 'ADMINISTRADOR',
                'employee_person_doc_type' => 'DNI',
                'employee_person_doc_num' => '70801887',
                'created' => FrozenDate::now()->format('Y-m-d'),
                'state' => 'ACTIVO',
            ],
        ];

        parent::init();
    }
}
