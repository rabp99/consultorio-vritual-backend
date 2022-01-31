<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ConsultingRoomsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ConsultingRoomsController Test Case
 *
 * @uses \App\Controller\ConsultingRoomsController
 */
class ConsultingRoomsControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
     * Test index method
     *
     * @return void
     * @uses \App\Controller\ConsultingRoomsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\ConsultingRoomsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\ConsultingRoomsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\ConsultingRoomsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test enable method
     *
     * @return void
     * @uses \App\Controller\ConsultingRoomsController::enable()
     */
    public function testEnable(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test disable method
     *
     * @return void
     * @uses \App\Controller\ConsultingRoomsController::disable()
     */
    public function testDisable(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
