<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\AppointmentsLaboratoryExamsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\AppointmentsLaboratoryExamsController Test Case
 *
 * @uses \App\Controller\AppointmentsLaboratoryExamsController
 */
class AppointmentsLaboratoryExamsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AppointmentsLaboratoryExams',
        'app.Appointments',
        'app.LaboratoryExams',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\AppointmentsLaboratoryExamsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\AppointmentsLaboratoryExamsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\AppointmentsLaboratoryExamsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\AppointmentsLaboratoryExamsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\AppointmentsLaboratoryExamsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
