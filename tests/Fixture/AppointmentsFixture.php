<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AppointmentsFixture
 */
class AppointmentsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'patient_person_doc_type' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'patient_person_doc_num' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'employee_person_doc_type' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'employee_person_doc_num' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'consulting_room_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'appointment_date' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'cost' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'state' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_appointments_consulting_rooms1_idx' => ['type' => 'index', 'columns' => ['consulting_room_id'], 'length' => []],
            'fk_appointments_patients1_idx' => ['type' => 'index', 'columns' => ['patient_person_doc_type', 'patient_person_doc_num'], 'length' => []],
            'fk_appointments_employees1_idx' => ['type' => 'index', 'columns' => ['employee_person_doc_type', 'employee_person_doc_num'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'id_UNIQUE' => ['type' => 'unique', 'columns' => ['id'], 'length' => []],
            'fk_appointments_patients1' => ['type' => 'foreign', 'columns' => ['patient_person_doc_type', 'patient_person_doc_num'], 'references' => ['patients', '1' => ['person_doc_type', 'person_doc_num']], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_appointments_employees1' => ['type' => 'foreign', 'columns' => ['employee_person_doc_type', 'employee_person_doc_num'], 'references' => ['employees', '1' => ['person_doc_type', 'person_doc_num']], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_appointments_consulting_rooms1' => ['type' => 'foreign', 'columns' => ['consulting_room_id'], 'references' => ['consulting_rooms', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'patient_person_doc_type' => 'Lorem ipsum dolor sit amet',
                'patient_person_doc_num' => 'Lorem ip',
                'employee_person_doc_type' => 'Lorem ipsum dolor sit amet',
                'employee_person_doc_num' => 'Lorem ip',
                'consulting_room_id' => 1,
                'appointment_date' => '2021-10-03 01:13:12',
                'cost' => 1.5,
                'created' => '2021-10-03 01:13:12',
                'modified' => '2021-10-03 01:13:12',
                'state' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
