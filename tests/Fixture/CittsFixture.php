<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\I18n\FrozenDate;
use Cake\TestSuite\Fixture\TestFixture;
use Faker\Factory;

/**
 * CittsFixture
 */
class CittsFixture extends TestFixture
{
    public $import = ['table' => 'citts'];

    public function init(): void
    {
        $faker = Factory::create('es_PE');
        $this->records = [];

        for ($i = 0; $i < 10; $i++) {
            $start_date = $faker->dateTimeBetween(FrozenDate::now()->format('Y-m-d'), FrozenDate::now()->modify('+2 week')->format('Y-m-d'));
            $end_date = $faker->dateTimeBetween(FrozenDate::now()->modify('+3 week')->format('Y-m-d'), FrozenDate::now()->modify('+4 week')->format('Y-m-d'));
            $interval = $start_date->diff($end_date);
            
            $this->records[] = [
                'appointment_id' => $faker->numberBetween(31, 60), 
                'start_date' => $start_date->format('Y-m-d'), 
                'end_date' => $end_date->format('Y-m-d'), 
                'number_days' => $interval->days, 
                'created' => FrozenDate::now()->format('Y-m-d')
            ];
        }

        parent::init();
    }
}
