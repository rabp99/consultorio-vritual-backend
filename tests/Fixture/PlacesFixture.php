<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\I18n\FrozenDate;
use Cake\TestSuite\Fixture\TestFixture;
use Faker\Factory;

/**
 * PlacesFixture
 */
class PlacesFixture extends TestFixture
{
    public $import = ['table' => 'places'];

    public function init(): void
    {
        $faker = Factory::create('es_PE');
        $this->records = [];

        for ($i = 0; $i < 3; $i++) {
            $this->records[] = [
                'description' => $faker->city,
                'address' => $faker->address,
                'created' => FrozenDate::now()->format('Y-m-d'),
                'state' => 'ACTIVO',
            ];
        }

        parent::init();
    }
}
