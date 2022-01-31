<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmployeesFixture
 */
class EmployeesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'person_doc_type' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'person_doc_num' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'cmp' => ['type' => 'char', 'length' => 6, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'state' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_employees_people1_idx' => ['type' => 'index', 'columns' => ['person_doc_type', 'person_doc_num'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['person_doc_type', 'person_doc_num'], 'length' => []],
            'cmp_UNIQUE' => ['type' => 'unique', 'columns' => ['cmp'], 'length' => []],
            'fk_employees_people1' => ['type' => 'foreign', 'columns' => ['person_doc_type', 'person_doc_num'], 'references' => ['people', '1' => ['doc_type', 'doc_num']], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'person_doc_type' => '96e0cf40-1629-4cf8-afcf-6ee52d7c61e0',
                'person_doc_num' => '85a51869-8271-48d8-ba2e-3087fc36a120',
                'cmp' => '',
                'created' => '2021-10-03 01:13:12',
                'modified' => '2021-10-03 01:13:12',
                'state' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
