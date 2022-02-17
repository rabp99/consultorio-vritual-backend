<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\I18n\FrozenDate;

/**
 * Patients seed.
 */
class PatientsSeed extends AbstractSeed
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
        $data = [];
        
        for ($i = 5; $i < 10; $i++) {
            $data[] = [
                'person_doc_type' => 'DNI',
                'person_doc_num' => str_repeat(strval($i), 8),
                'created' => FrozenDate::now(),
                'state' => 'ACTIVO'
            ];
        }

        for ($i = 5; $i < 10; $i++) {
            $data[] = [
                'person_doc_type' => 'CEX',
                'person_doc_num' => str_repeat(strval($i), 8),
                'created' => FrozenDate::now(),
                'state' => 'ACTIVO'
            ];
        }
        
        $data[] = [
            'person_doc_type' => 'DNI',
            'person_doc_num' => '87654321',
            'created' => FrozenDate::now(),
            'state' => 'INACTIVO'
        ];
        
        $table = $this->table('patients');
        $table->insert($data)->save();
    }
}