<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\I18n\FrozenDate;
use Cake\TestSuite\Fixture\TestFixture;
use Faker\Factory;

/**
 * MedicinesFixture
 */
class MedicinesFixture extends TestFixture
{
    public $import = ['table' => 'medicines'];

    public function init(): void
    {
        $faker = Factory::create('es_PE');
        $this->records = [];

        for ($i = 0; $i < 200; $i++) {
            $this->records[] = [
                'description' => $faker->text(20),
                'presentation' => $faker->text(10),
                'created' => FrozenDate::now(),
                'state' => 'ACTIVO',
            ];
        }

        parent::init();
    }
}
