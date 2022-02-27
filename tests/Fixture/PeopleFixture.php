<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\I18n\FrozenDate;
use Cake\TestSuite\Fixture\TestFixture;
use Faker\Factory;

/**
 * PeopleFixture
 */
class PeopleFixture extends TestFixture
{
    public $import = ['table' => 'people'];

    public function init(): void
    {
        $faker = Factory::create('es_PE');
        $this->records = [];

        for ($i = 0; $i < 10; $i++) {
            $this->records[] = [
                'doc_type' => 'DNI',
                'doc_num' => str_repeat(strval($i), 8),
                'names' => $faker->name,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'birth' => FrozenDate::now()->format('Y-m-d'),
                'nationality' => 'PERÚ',
                'created' => FrozenDate::now()->format('Y-m-d'),
                'gendre' => $faker->randomElement(['M', 'F']),
            ];
        }

        for ($i = 0; $i < 10; $i++) {
            $this->records[] = [
                'doc_type' => 'CEX',
                'doc_num' => str_repeat(strval($i), 8),
                'names' => $faker->name,
                'last_name1' => $faker->lastName,
                'last_name2' => $faker->lastName,
                'birth' => FrozenDate::now()->format('Y-m-d'),
                'nationality' => 'PERÚ',
                'created' => FrozenDate::now()->format('Y-m-d'),
                'gendre' => $faker->randomElement(['M', 'F']),
            ];
        }

        $this->records[] = [
            'doc_type' => 'DNI',
            'doc_num' => '12345678',
            'names' => $faker->name,
            'last_name1' => $faker->lastName,
            'last_name2' => $faker->lastName,
            'birth' => FrozenDate::now()->format('Y-m-d'),
            'nationality' => 'PERÚ',
            'created' => FrozenDate::now()->format('Y-m-d'),
            'gendre' => $faker->randomElement(['M', 'F']),
        ];

        $this->records[] = [
            'doc_type' => 'DNI',
            'doc_num' => '87654321',
            'names' => $faker->name,
            'last_name1' => $faker->lastName,
            'last_name2' => $faker->lastName,
            'birth' => FrozenDate::now()->format('Y-m-d'),
            'nationality' => 'PERÚ',
            'created' => FrozenDate::now()->format('Y-m-d'),
            'gendre' => $faker->randomElement(['M', 'F']),
        ];

        parent::init();
    }
}
