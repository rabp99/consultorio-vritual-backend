<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConsultingRoomsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConsultingRoomsTable Test Case
 */
class ConsultingRoomsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ConsultingRoomsTable
     */
    protected $ConsultingRooms;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ConsultingRooms',
        'app.Places',
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
        $config = $this->getTableLocator()->exists('ConsultingRooms') ? [] : ['className' => ConsultingRoomsTable::class];
        $this->ConsultingRooms = $this->getTableLocator()->get('ConsultingRooms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ConsultingRooms);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ConsultingRoomsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ConsultingRoomsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
