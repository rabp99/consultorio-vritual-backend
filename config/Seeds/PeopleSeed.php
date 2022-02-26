<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\I18n\FrozenDate;
use Faker\Factory;

/**
 * People seed.
 */
class PeopleSeed extends AbstractSeed
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
                'doc_type' => 'DNI', 
                'doc_num' => str_repeat(strval($i), 8),
                'names' => $faker->name, 
                'last_name1' => $faker->lastName, 
                'last_name2' => $faker->lastName, 
                'birth' => FrozenDate::now()->format('Y-m-d'), 
                'nationality' => 'PERÚ', 
                'created' => FrozenDate::now()->format('Y-m-d'), 
                'gendre' => $faker->randomElement(['M', 'F']), 
            ];
        }
        
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'doc_type' => 'CEX', 
                'doc_num' => str_repeat(strval($i), 8),
                'names' => $faker->name, 
                'last_name1' => $faker->lastName, 
                'last_name2' => $faker->lastName, 
                'birth' => FrozenDate::now()->format('Y-m-d'), 
                'nationality' => 'PERÚ', 
                'created' => FrozenDate::now()->format('Y-m-d'), 
                'gendre' => $faker->randomElement(['M', 'F']), 
            ];
        }
        
        $data[] = [
            'doc_type' => 'DNI', 
            'doc_num' => '12345678',
            'names' => $faker->name, 
            'last_name1' => $faker->lastName, 
            'last_name2' => $faker->lastName, 
            'birth' => FrozenDate::now()->format('Y-m-d'), 
            'nationality' => 'PERÚ', 
            'created' => FrozenDate::now()->format('Y-m-d'), 
            'gendre' => $faker->randomElement(['M', 'F']), 
        ];
        
        $data[] = [
            'doc_type' => 'DNI', 
            'doc_num' => '87654321',
            'names' => $faker->name, 
            'last_name1' => $faker->lastName, 
            'last_name2' => $faker->lastName, 
            'birth' => FrozenDate::now()->format('Y-m-d'), 
            'nationality' => 'PERÚ', 
            'created' => FrozenDate::now()->format('Y-m-d'), 
            'gendre' => $faker->randomElement(['M', 'F']), 
        ];
        
        
        $table = $this->table('people');
        $table->insert($data)->save();
    }
}