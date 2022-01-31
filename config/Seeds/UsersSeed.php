<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\ORM\TableRegistry;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run() {
        $usersTable = TableRegistry::getTableLocator()->get('users');
        
        $user = $usersTable->newEmptyEntity();
        $user->username = "70801887";
        $user->email = "rabp_91@hotmail.com";
        $user->password = "70801887";
        $user->rol = "Administrador";
        $usersTable->save($user);        
    }
}