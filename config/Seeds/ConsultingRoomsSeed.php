<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\I18n\FrozenDate;
use Faker\Factory;

/**
 * ConsultingRooms seed.
 */
class ConsultingRoomsSeed extends AbstractSeed
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
            $data[] = [
                'description' => $faker->numberBetween(1, 99),
                'floor' => $faker->numberBetween(1, 999),
                'place_id' => $faker->numberBetween(1, 3),
                'created' => FrozenDate::now()->format('Y-m-d'), 
                'state' => 'ACTIVO'
            ];
        }
        
        $table = $this->table('consulting_rooms');
        $table->insert($data)->save();
    }
}