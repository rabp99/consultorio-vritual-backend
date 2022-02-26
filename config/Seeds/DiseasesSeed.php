<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Faker\Factory;
use Cake\I18n\FrozenDate;

/**
 * Diseases seed.
 */
class DiseasesSeed extends AbstractSeed
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
        
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'description' => $faker->text(20), 
                'created' => FrozenDate::now()->format('Y-m-d'), 
                'state' => 'ACTIVO'
            ];
        }
        
        $table = $this->table('diseases');
        $table->insert($data)->save();
    }
}