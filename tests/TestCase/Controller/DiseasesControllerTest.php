<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\DiseasesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\DiseasesController Test Case
 *
 * @uses \App\Controller\DiseasesController
 */
class DiseasesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Diseases',
        'app.Diagnostics',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\DiseasesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\DiseasesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\DiseasesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\DiseasesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test enable method
     *
     * @return void
     * @uses \App\Controller\DiseasesController::enable()
     */
    public function testEnable(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test disable method
     *
     * @return void
     * @uses \App\Controller\DiseasesController::disable()
     */
    public function testDisable(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
