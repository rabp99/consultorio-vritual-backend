<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\LaboratoryExamsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\LaboratoryExamsController Test Case
 *
 * @uses \App\Controller\LaboratoryExamsController
 */
class LaboratoryExamsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.LaboratoryExams',
        'app.Appointments',
        'app.AppointmentsLaboratoryExams',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\LaboratoryExamsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\LaboratoryExamsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\LaboratoryExamsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\LaboratoryExamsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test enable method
     *
     * @return void
     * @uses \App\Controller\LaboratoryExamsController::enable()
     */
    public function testEnable(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test disable method
     *
     * @return void
     * @uses \App\Controller\LaboratoryExamsController::disable()
     */
    public function testDisable(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
