<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DiagnosticsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DiagnosticsTable Test Case
 */
class DiagnosticsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DiagnosticsTable
     */
    protected $Diagnostics;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Diagnostics',
        'app.Appointments',
        'app.Diseases',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Diagnostics') ? [] : ['className' => DiagnosticsTable::class];
        $this->Diagnostics = $this->getTableLocator()->get('Diagnostics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Diagnostics);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DiagnosticsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DiagnosticsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
