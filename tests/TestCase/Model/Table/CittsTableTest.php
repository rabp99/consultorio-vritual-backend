<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CittsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CittsTable Test Case
 */
class CittsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CittsTable
     */
    protected $Citts;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Citts',
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
        $config = $this->getTableLocator()->exists('Citts') ? [] : ['className' => CittsTable::class];
        $this->Citts = $this->getTableLocator()->get('Citts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Citts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CittsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CittsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
