<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\I18n\FrozenDate;
use Faker\Factory;

/**
 * Appointments seed.
 */
class AppointmentsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run() {
        $faker = Factory::create("es_PE");
        $data = [];
        
        for ($i = 0; $i < 30; $i++) {
            $appointment_date = $faker->dateTimeBetween(FrozenDate::now()->format('Y-m-d'), FrozenDate::now()->modify('+2 month')->format('Y-m-d'));
            $data[] = [
                'patient_person_doc_type' => 'DNI',
                'patient_person_doc_num' => $faker->randomElement(['55555555', '66666666', '77777777', '88888888', '99999999']),
                'employee_person_doc_type' => 'DNI',
                'employee_person_doc_num' => $faker->randomElement(['00000000', '11111111', '22222222', '33333333', '44444444']),
                'consulting_room_id' => $faker->numberBetween(1, 10),
                'appointment_date' => $appointment_date->format('Y-m-d'),
                'cost' => $faker->numberBetween(1, 100) * 10,
                'state' => 'PENDIENTE',
                'user_created' => '70801887'
            ];
        }
        
        for ($i = 0; $i < 30; $i++) {
            $appointment_date = $faker->dateTimeBetween(FrozenDate::now()->modify('-1 month')->format('Y-m-d'), FrozenDate::now()->format('Y-m-d'));
            $data[] = [
                'patient_person_doc_type' => 'DNI',
                'patient_person_doc_num' => $faker->randomElement(['55555555', '66666666', '77777777', '88888888', '99999999']),
                'employee_person_doc_type' => 'DNI',
                'employee_person_doc_num' => $faker->randomElement(['00000000', '11111111', '22222222', '33333333', '44444444']),
                'consulting_room_id' => $faker->numberBetween(1, 10),
                'appointment_date' => $appointment_date->format('Y-m-d'),
                'cost' => $faker->numberBetween(1, 100) * 10,
                'state' => 'TERMINADA',
                'user_created' => '70801887'
            ];
        }
        
        for ($i = 0; $i < 30; $i++) {
            $appointment_date = $faker->dateTimeBetween(FrozenDate::now()->format('Y-m-d'), FrozenDate::now()->modify('+2 month')->format('Y-m-d'));
            $data[] = [
                'patient_person_doc_type' => 'DNI',
                'patient_person_doc_num' => $faker->randomElement(['55555555', '66666666', '77777777', '88888888', '99999999']),
                'employee_person_doc_type' => 'DNI',
                'employee_person_doc_num' => $faker->randomElement(['00000000', '11111111', '22222222', '33333333', '44444444']),
                'consulting_room_id' => $faker->numberBetween(1, 10),
                'appointment_date' => $appointment_date->format('Y-m-d'),
                'cost' => $faker->numberBetween(1, 100) * 10,
                'state' => 'REPROGRAMADA',
                'user_created' => '70801887'
            ];
        }
        
        for ($i = 0; $i < 30; $i++) {
            $appointment_date = $faker->dateTimeBetween(FrozenDate::now()->modify('-2 month')->format('Y-m-d'), FrozenDate::now()->modify('+1 month')->format('Y-m-d'));
            $cancel_date = $faker->dateTimeBetween(FrozenDate::now()->modify('-1 month'), FrozenDate::now());
            $data[] = [
                'patient_person_doc_type' => 'DNI',
                'patient_person_doc_num' => $faker->randomElement(['55555555', '66666666', '77777777', '88888888', '99999999']),
                'employee_person_doc_type' => 'DNI',
                'employee_person_doc_num' => $faker->randomElement(['00000000', '11111111', '22222222', '33333333', '44444444']),
                'consulting_room_id' => $faker->numberBetween(1, 10),
                'appointment_date' => $appointment_date->format('Y-m-d'),
                'cancel_date' => $cancel_date->format('Y-m-d'),
                'cost' => $faker->numberBetween(1, 100) * 10,
                'state' => 'CANCELADA',
                'user_created' => '70801887'
            ];
        }
        
        $table = $this->table('appointments');
        $table->insert($data)->save();
    }
}