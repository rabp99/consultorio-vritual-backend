<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\I18n\FrozenDate;
use Cake\TestSuite\Fixture\TestFixture;
use Faker\Factory;

/**
 * RecipesFixture
 */
class RecipesFixture extends TestFixture
{
    public $import = ['table' => 'recipes'];

    public function init(): void
    {
        $faker = Factory::create('es_PE');
        $this->records = [];

        for ($i = 0; $i < 200; $i++) {
            $this->records[] = [
                'appointment_id' => $faker->numberBetween(31, 60),
                'medicine_id' => $faker->numberBetween(1, 200),
                'amount' => $faker->numberBetween(1, 30),
                'days' => $faker->numberBetween(1, 12),
                'prescription' => $faker->text(60),
                'created' => FrozenDate::now(),
            ];
        }

        parent::init();
    }
}
