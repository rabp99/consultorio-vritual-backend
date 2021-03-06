<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\I18n\FrozenDate;
use Cake\TestSuite\Fixture\TestFixture;
use Faker\Factory;

/**
 * EmployeesFixture
 */
class EmployeesFixture extends TestFixture
{
    public $import = ['table' => 'employees'];

    public function init(): void
    {
        $faker = Factory::create('es_PE');
        $this->records = [];

        for ($i = 0; $i < 5; $i++) {
            $this->records[] = [
                'person_doc_type' => 'DNI',
                'person_doc_num' => str_repeat(strval($i), 8),
                'cmp' => $faker->numberBetween(111111, 999999),
                'created' => FrozenDate::now()->format('Y-m-d'),
                'state' => 'ACTIVO',
            ];
        }

        for ($i = 0; $i < 5; $i++) {
            $this->records[] = [
                'person_doc_type' => 'CEX',
                'person_doc_num' => str_repeat(strval($i), 8),
                'cmp' => $faker->numberBetween(111111, 999999),
                'created' => FrozenDate::now()->format('Y-m-d'),
                'state' => 'ACTIVO',
            ];
        }

        $this->records[] = [
            'person_doc_type' => 'DNI',
            'person_doc_num' => '12345678',
            'cmp' => $faker->numberBetween(111111, 999999),
            'created' => FrozenDate::now()->format('Y-m-d'),
            'state' => 'INACTIVO',
        ];

        parent::init();
    }
}
