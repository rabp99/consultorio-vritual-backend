<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\I18n\FrozenDate;

/**
 * EmployeeRecords seed.
 */
class EmployeeRecordsSeed extends AbstractSeed
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
        
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'employee_person_doc_type' => 'DNI',
                'employee_person_doc_num' => str_repeat(strval($i), 8),
                'start' => FrozenDate::now()->format('Y-m-d'), 
                'created' => FrozenDate::now()->format('Y-m-d'), 
            ];
        }
        
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'employee_person_doc_type' => 'CEX',
                'employee_person_doc_num' => str_repeat(strval($i), 8),
                'start' => FrozenDate::now()->format('Y-m-d'), 
                'created' => FrozenDate::now()->format('Y-m-d'), 
            ];
        }
        
        $data[] = [
            'employee_person_doc_type' => 'DNI',
            'employee_person_doc_num' => '12345678',
            'start' => FrozenDate::now()->modify('- 2days')->format('Y-m-d'), 
            'end' => FrozenDate::now()->format('Y-m-d'), 
            'created' => FrozenDate::now()->format('Y-m-d'), 
            'modified' => FrozenDate::now()->format('Y-m-d'), 
        ];
        
        $table = $this->table('employee_records');
        $table->insert($data)->save();
    }
}