<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\I18n\FrozenDate;
use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmployeeRecordsFixture
 */
class EmployeeRecordsFixture extends TestFixture
{
    public $import = ['table' => 'employee_records'];

    public function init(): void
    {
        $this->records = [];

        for ($i = 0; $i < 5; $i++) {
            $this->records[] = [
                'employee_person_doc_type' => 'DNI',
                'employee_person_doc_num' => str_repeat(strval($i), 8),
                'start' => FrozenDate::now(),
                'created' => FrozenDate::now(),
            ];
        }

        for ($i = 0; $i < 5; $i++) {
            $this->records[] = [
                'employee_person_doc_type' => 'CEX',
                'employee_person_doc_num' => str_repeat(strval($i), 8),
                'start' => FrozenDate::now(),
                'created' => FrozenDate::now(),
            ];
        }

        $this->records[] = [
            'employee_person_doc_type' => 'DNI',
            'employee_person_doc_num' => '12345678',
            'start' => FrozenDate::now()->modify('- 2days'),
            'end' => FrozenDate::now(),
            'created' => FrozenDate::now(),
            'modified' => FrozenDate::now(),
        ];

        parent::init();
    }
}
