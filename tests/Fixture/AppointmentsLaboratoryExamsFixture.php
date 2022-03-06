<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\I18n\FrozenDate;
use Cake\TestSuite\Fixture\TestFixture;
use Faker\Factory;

/**
 * AppointmentsLaboratoryExamsFixture
 */
class AppointmentsLaboratoryExamsFixture extends TestFixture
{
    public $import = ['table' => 'appointments_laboratory_exams'];

    public function init(): void
    {
        $faker = Factory::create('es_PE');
        $this->records = [];

        for ($i = 0; $i < 24; $i++) {
            $this->records[] = [
                'appointment_id' => $faker->numberBetween(31, 60),
                'laboratory_exam_id' => $faker->numberBetween(1, 23),
                'created' => FrozenDate::now()->format('Y-m-d'),
            ];
        }

        parent::init();
    }
}
