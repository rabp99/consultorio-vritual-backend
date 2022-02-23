<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AppointmentsLaboratoryExamsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AppointmentsLaboratoryExamsTable Test Case
 */
class AppointmentsLaboratoryExamsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AppointmentsLaboratoryExamsTable
     */
    protected $AppointmentsLaboratoryExams;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AppointmentsLaboratoryExams',
        'app.Appointments',
        'app.LaboratoryExams',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AppointmentsLaboratoryExams') ? [] : ['className' => AppointmentsLaboratoryExamsTable::class];
        $this->AppointmentsLaboratoryExams = $this->getTableLocator()->get('AppointmentsLaboratoryExams', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AppointmentsLaboratoryExams);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AppointmentsLaboratoryExamsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
