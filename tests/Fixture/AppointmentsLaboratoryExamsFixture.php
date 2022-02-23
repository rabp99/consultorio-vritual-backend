<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AppointmentsLaboratoryExamsFixture
 */
class AppointmentsLaboratoryExamsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'appointment_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'laboratory_exam_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'fk_appointments_has_laboratory_exams_laboratory_exams1_idx' => ['type' => 'index', 'columns' => ['laboratory_exam_id'], 'length' => []],
            'fk_appointments_has_laboratory_exams_appointments1_idx' => ['type' => 'index', 'columns' => ['appointment_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['appointment_id', 'laboratory_exam_id'], 'length' => []],
            'fk_appointments_has_laboratory_exams_laboratory_exams1' => ['type' => 'foreign', 'columns' => ['laboratory_exam_id'], 'references' => ['laboratory_exams', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_appointments_has_laboratory_exams_appointments1' => ['type' => 'foreign', 'columns' => ['appointment_id'], 'references' => ['appointments', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'appointment_id' => 1,
                'laboratory_exam_id' => 1,
                'created' => '2022-02-23 00:36:10',
                'modified' => '2022-02-23 00:36:10',
            ],
        ];
        parent::init();
    }
}
