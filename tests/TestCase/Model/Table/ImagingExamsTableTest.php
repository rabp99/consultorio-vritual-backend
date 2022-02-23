<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ImagingExamsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ImagingExamsTable Test Case
 */
class ImagingExamsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ImagingExamsTable
     */
    protected $ImagingExams;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ImagingExams',
        'app.Appointments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ImagingExams') ? [] : ['className' => ImagingExamsTable::class];
        $this->ImagingExams = $this->getTableLocator()->get('ImagingExams', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ImagingExams);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ImagingExamsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
