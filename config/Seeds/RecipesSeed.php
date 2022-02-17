<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Faker\Factory;
use Cake\I18n\FrozenDate;

/**
 * Recipes seed.
 */
class RecipesSeed extends AbstractSeed
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
        
        for ($i = 0; $i < 200; $i++) {
            $data[] = [
                'appointment_id' => $faker->numberBetween(31, 60),
                'medicine_id' => $faker->numberBetween(1, 200),
                'amount' => $faker->numberBetween(1, 30),
                'days' => $faker->numberBetween(1, 12),
                'prescription' => $faker->text(60),
                'created' => FrozenDate::now(),
            ];
        }
        
        $table = $this->table('recipes');
        $table->insert($data)->save();
    }
}