<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\I18n\FrozenDate;
use Faker\Factory;

/**
 * Employees seed.
 */
class EmployeesSeed extends AbstractSeed
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
        $faker = Factory::create("es_PE");
        $data = [];
        
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'person_doc_type' => 'DNI',
                'person_doc_num' => str_repeat(strval($i), 8),
                'cmp' => $faker->numberBetween(111111, 999999),
                'created' => FrozenDate::now(),
                'state' => 'ACTIVO'
            ];
        }
        
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'person_doc_type' => 'CEX',
                'person_doc_num' => str_repeat(strval($i), 8),
                'cmp' => $faker->numberBetween(111111, 999999),
                'created' => FrozenDate::now(),
                'state' => 'ACTIVO'
            ];
        }
        
        $data[] = [
            'person_doc_type' => 'DNI',
            'person_doc_num' => '12345678',
            'cmp' => $faker->numberBetween(111111, 999999),
            'created' => FrozenDate::now(),
            'state' => 'INACTIVO'
        ];
        
        $table = $this->table('employees');
        $table->insert($data)->save();
    }
}