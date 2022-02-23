<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ImagingExamsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ImagingExamsController Test Case
 *
 * @uses \App\Controller\ImagingExamsController
 */
class ImagingExamsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ImagingExams',
        'app.Appointments',
        'app.AppointmentsImagingExams',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\ImagingExamsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\ImagingExamsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\ImagingExamsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\ImagingExamsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test enable method
     *
     * @return void
     * @uses \App\Controller\ImagingExamsController::enable()
     */
    public function testEnable(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test disable method
     *
     * @return void
     * @uses \App\Controller\ImagingExamsController::disable()
     */
    public function testDisable(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
