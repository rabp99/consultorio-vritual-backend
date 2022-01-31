<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\PlacesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\PlacesController Test Case
 *
 * @uses \App\Controller\PlacesController
 */
class PlacesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Places',
        'app.ConsultingRooms',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\PlacesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\PlacesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\PlacesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\PlacesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test enable method
     *
     * @return void
     * @uses \App\Controller\PlacesController::enable()
     */
    public function testEnable(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test disable method
     *
     * @return void
     * @uses \App\Controller\PlacesController::disable()
     */
    public function testDisable(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
