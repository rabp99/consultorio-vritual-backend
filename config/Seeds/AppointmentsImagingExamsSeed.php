<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Faker\Factory;
use Cake\I18n\FrozenDate;

/**
 * AppointmentsImagingExams seed.
 */
class AppointmentsImagingExamsSeed extends AbstractSeed
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
        
        for ($i = 0; $i < 24; $i++) {
            $data[] = [
                'appointment_id' => $faker->numberBetween(31, 60),
                'imaging_exam_id' => $faker->numberBetween(1, 23),
                'created' => FrozenDate::now()->format('Y-m-d'),
            ];
        }
        
        $table = $this->table('appointments_imaging_exams');
        $table->insert($data)->save();
    }
}