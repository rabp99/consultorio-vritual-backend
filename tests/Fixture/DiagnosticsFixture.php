<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\I18n\FrozenDate;
use Cake\TestSuite\Fixture\TestFixture;
use Faker\Factory;

/**
 * DiagnosticsFixture
 */
class DiagnosticsFixture extends TestFixture
{
    public $import = ['table' => 'diagnostics'];

    public function init(): void
    {
        $faker = Factory::create('es_PE');
        $this->records = [];

        for ($i = 0; $i < 300; $i++) {
            $this->records[] = [
                'appointment_id' => $faker->numberBetween(31, 60),
                'disease_id' => $faker->numberBetween(1, 100),
                'created' => FrozenDate::now(),
            ];
        }

        parent::init();
    }
}
