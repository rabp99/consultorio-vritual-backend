<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\I18n\FrozenDate;
use Cake\TestSuite\Fixture\TestFixture;
use Faker\Factory;

/**
 * AppointmentsFixture
 */
class AppointmentsFixture extends TestFixture
{
    public $import = ['table' => 'appointments'];

    public function init(): void
    {
        $faker = Factory::create('es_PE');
        $this->records = [];

        for ($i = 0; $i < 30; $i++) {
            $appointment_date = $faker->dateTimeBetween(FrozenDate::now(), FrozenDate::now()->modify('+2 month'));
            $this->records[] = [
                'patient_person_doc_type' => 'DNI',
                'patient_person_doc_num' => $faker->randomElement(['55555555', '66666666', '77777777', '88888888', '99999999']),
                'employee_person_doc_type' => 'DNI',
                'employee_person_doc_num' => $faker->randomElement(['00000000', '11111111', '22222222', '33333333', '44444444']),
                'consulting_room_id' => $faker->numberBetween(1, 10),
                'appointment_date' => $appointment_date,
                'cost' => $faker->numberBetween(1, 100) * 10,
                'state' => 'PENDIENTE',
                'user_created' => '70801887',
            ];
        }

        for ($i = 0; $i < 30; $i++) {
            $appointment_date = $faker->dateTimeBetween(FrozenDate::now()->modify('-1 month'), FrozenDate::now());
            $this->records[] = [
                'patient_person_doc_type' => 'DNI',
                'patient_person_doc_num' => $faker->randomElement(['55555555', '66666666', '77777777', '88888888', '99999999']),
                'employee_person_doc_type' => 'DNI',
                'employee_person_doc_num' => $faker->randomElement(['00000000', '11111111', '22222222', '33333333', '44444444']),
                'consulting_room_id' => $faker->numberBetween(1, 10),
                'appointment_date' => $appointment_date,
                'cost' => $faker->numberBetween(1, 100) * 10,
                'state' => 'TERMINADA',
                'user_created' => '70801887',
            ];
        }

        for ($i = 0; $i < 30; $i++) {
            $appointment_date = $faker->dateTimeBetween(FrozenDate::now(), FrozenDate::now()->modify('+2 month'));
            $this->records[] = [
                'patient_person_doc_type' => 'DNI',
                'patient_person_doc_num' => $faker->randomElement(['55555555', '66666666', '77777777', '88888888', '99999999']),
                'employee_person_doc_type' => 'DNI',
                'employee_person_doc_num' => $faker->randomElement(['00000000', '11111111', '22222222', '33333333', '44444444']),
                'consulting_room_id' => $faker->numberBetween(1, 10),
                'appointment_date' => $appointment_date,
                'cost' => $faker->numberBetween(1, 100) * 10,
                'state' => 'REPROGRAMADA',
                'user_created' => '70801887',
            ];
        }

        for ($i = 0; $i < 30; $i++) {
            $appointment_date = $faker->dateTimeBetween(FrozenDate::now()->modify('-2 month'), FrozenDate::now()->modify('+1 month'));
            $cancel_date = $faker->dateTimeBetween(FrozenDate::now()->modify('-1 month'), FrozenDate::now());
            $this->records[] = [
                'patient_person_doc_type' => 'DNI',
                'patient_person_doc_num' => $faker->randomElement(['55555555', '66666666', '77777777', '88888888', '99999999']),
                'employee_person_doc_type' => 'DNI',
                'employee_person_doc_num' => $faker->randomElement(['00000000', '11111111', '22222222', '33333333', '44444444']),
                'consulting_room_id' => $faker->numberBetween(1, 10),
                'appointment_date' => $appointment_date,
                'cancel_date' => $cancel_date,
                'cost' => $faker->numberBetween(1, 100) * 10,
                'state' => 'CANCELADA',
                'user_created' => '70801887',
            ];
        }

        parent::init();
    }
}
