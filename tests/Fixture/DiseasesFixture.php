<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\I18n\FrozenDate;
use Cake\TestSuite\Fixture\TestFixture;
use Faker\Factory;

/**
 * DiseasesFixture
 */
class DiseasesFixture extends TestFixture
{
    public $import = ['table' => 'diseases'];

    public function init(): void
    {
        $faker = Factory::create('es_PE');
        $this->records = [];

        for ($i = 0; $i < 100; $i++) {
            $this->records[] = [
                'description' => $faker->text(20),
                'created' => FrozenDate::now()->format('Y-m-d'),
                'state' => 'ACTIVO',
            ];
        }

        parent::init();
    }
}
