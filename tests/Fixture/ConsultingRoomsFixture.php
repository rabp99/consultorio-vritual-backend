<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\I18n\FrozenDate;
use Cake\TestSuite\Fixture\TestFixture;
use Faker\Factory;

/**
 * ConsultingRoomsFixture
 */
class ConsultingRoomsFixture extends TestFixture
{
    public $import = ['table' => 'consulting_rooms'];

    public function init(): void
    {
        $faker = Factory::create('es_PE');
        $this->records = [];

        for ($i = 0; $i < 10; $i++) {
            $this->records[] = [
                'description' => $faker->numberBetween(1, 99),
                'floor' => $faker->numberBetween(1, 999),
                'place_id' => $faker->numberBetween(1, 3),
                'created' => FrozenDate::now(),
                'state' => 'ACTIVO',
            ];
        }

        parent::init();
    }
}
