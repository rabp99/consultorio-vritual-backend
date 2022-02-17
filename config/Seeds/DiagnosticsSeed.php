<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Faker\Factory;
use Cake\I18n\FrozenDate;

/**
 * Diagnostics seed.
 */
class DiagnosticsSeed extends AbstractSeed
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
        
        for ($i = 0; $i < 300; $i++) {
            $data[] = [
                'appointment_id' => $faker->numberBetween(31, 60),
                'disease_id' => $faker->numberBetween(1, 100),
                'created' => FrozenDate::now()
            ];
        }
        
        $table = $this->table('diagnostics');
        $table->insert($data)->save();
    }
}