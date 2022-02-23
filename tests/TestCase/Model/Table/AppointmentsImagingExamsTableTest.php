<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AppointmentsImagingExamsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AppointmentsImagingExamsTable Test Case
 */
class AppointmentsImagingExamsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AppointmentsImagingExamsTable
     */
    protected $AppointmentsImagingExams;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AppointmentsImagingExams',
        'app.Appointments',
        'app.ImagingExams',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AppointmentsImagingExams') ? [] : ['className' => AppointmentsImagingExamsTable::class];
        $this->AppointmentsImagingExams = $this->getTableLocator()->get('AppointmentsImagingExams', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AppointmentsImagingExams);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AppointmentsImagingExamsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
