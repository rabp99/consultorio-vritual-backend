<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\I18n\FrozenDate;
use Faker\Factory;

/**
 * Citts seed.
 */
class CittsSeed extends AbstractSeed
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
        
        for ($i = 0; $i < 10; $i++) {
            $start_date = $faker->dateTimeBetween(FrozenDate::now()->format('Y-m-d'), FrozenDate::now()->modify('+2 week')->format('Y-m-d'));
            $end_date = $faker->dateTimeBetween(FrozenDate::now()->modify('+3 week')->format('Y-m-d'), FrozenDate::now()->modify('+4 week')->format('Y-m-d'));
            $interval = $start_date->diff($end_date);
            
            $data[] = [
                'appointment_id' => $faker->numberBetween(31, 60), 
                'start_date' => $start_date->format('Y-m-d'), 
                'end_date' => $end_date->format('Y-m-d'), 
                'number_days' => $interval->days, 
                'created' => FrozenDate::now()->format('Y-m-d')
            ];
        }
        
        $table = $this->table('citts');
        $table->insert($data)->save();
    }
}