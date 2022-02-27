<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\AppointmentsController Test Case
 *
 * @uses \App\Controller\AppointmentsController
 */
class AppointmentsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    private $peopleTable;
    private $patientsTable;
    private $employeesTable;
    private $consultingRoomsTable;
    private $appointmentsTable;
    private $diseasesTable;
    private $diagnosticsTable;
    private $medicinesTable;
    private $recipesTable;

    public function getFixtures(): array
    {
        $this->addFixture('app.People')
            ->addFixture('app.Patients')
            ->addFixture('app.Employees')
            ->addFixture('app.ConsultingRooms')
            ->addFixture('app.Users')
            ->addFixture('app.Appointments')
            ->addFixture('app.Diseases')
            ->addFixture('app.Diagnostics')
            ->addFixture('app.Medicines')
            ->addFixture('app.Recipes');

        return parent::getFixtures();
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->configRequest([
            'headers' => ['Accept' => 'application/json'],
        ]);
        $data = [
            'username' => '70801887',
            'password' => '70801887',
        ];
        $this->post('/api/users/login.json', $data);
        $token = json_decode((string)$this->_response->getBody(), true)['token'];
        $this->configRequest([
            'headers' => [
                'Authorization' => "Bearer $token",
            ],
        ]);

        $this->peopleTable = TableRegistry::getTableLocator()->get('People');
        $this->patientsTable = TableRegistry::getTableLocator()->get('Patients');
        $this->employeesTable = TableRegistry::getTableLocator()->get('Employees');
        $this->consultingRoomsTable = TableRegistry::getTableLocator()->get('ConsultingRooms');
        $this->appointmentsTable = TableRegistry::getTableLocator()->get('Appointments');
        $this->diseasesTable = TableRegistry::getTableLocator()->get('Diseases');
        $this->diagnosticsTable = TableRegistry::getTableLocator()->get('Diagnostics');
        $this->medicinesTable = TableRegistry::getTableLocator()->get('Medicines');
        $this->recipesTable = TableRegistry::getTableLocator()->get('Recipes');
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void
    {
        $this->get('/api/appointments.json');
        $this->assertResponseOk();
        $this->assertResponseContains('"count": 120');
    }

    /**
     * Test index with filters method
     *
     * @return void
     */
    public function testIndexWithFilters(): void
    {
        $countAppointments = $this->appointmentsTable->find()->where(['state' => 'PENDIENTE', 'patient_person_doc_type' => 'DNI'])->count();
        $this->get('/api/appointments.json?state=PENDIENTE&patient_person_doc_type=DNI');

        $this->assertResponseOk();
        $this->assertResponseContains("\"count\": $countAppointments");
    }

    /**
     * Test View method
     *
     * @return void
     */
    public function testView(): void
    {
        $appointment = $this->appointmentsTable->get(1);
        $this->get('/api/appointments/1.json');

        $this->assertResponseOk();
        $this->assertResponseContains("\"patient\": {\n");
        $this->assertResponseContains("\"employee\": {\n");
        $this->assertResponseContains("\"consulting_room\": {\n");
        $this->assertResponseContains('"diagnostics": [');
        $this->assertResponseContains('"recipes": [');
        $this->assertResponseContains("\"cost\": \"$appointment->cost\"");
    }

    /**
     * Test add clean method
     *
     * @return void
     */
    public function testAddClean(): void
    {
        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
        $countEmployeesBefore = $this->employeesTable->find()->count();
        $countConsultingRoomsBefore = $this->consultingRoomsTable->find()->count();
        $countAppointmentsBefore = $this->appointmentsTable->find()->count();

        $data = [
            'patient_person_doc_type' => 'DNI',
            'patient_person_doc_num' => '66666666',
            'employee_person_doc_type' => 'DNI',
            'employee_person_doc_num' => '22222222',
            'consulting_room_id' => 1,
            'appointment_date' => FrozenDate::now(),
            'cost' => 50,
            'state' => 'PENDIENTE',
        ];

        $this->post('/api/appointments.json', $data);

        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
        $countEmployeesAfter = $this->employeesTable->find()->count();
        $countConsultingRoomsAfter = $this->consultingRoomsTable->find()->count();
        $countAppointmentsAfter = $this->appointmentsTable->find()->count();

        $this->assertResponseOk();
        $this->assertResponseContains('"message": "La cita fue registrada correctamente"');
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore, $countPatientsAfter);
        $this->assertEquals($countEmployeesBefore, $countEmployeesAfter);
        $this->assertEquals($countConsultingRoomsBefore, $countConsultingRoomsAfter);
        $this->assertEquals($countAppointmentsBefore + 1, $countAppointmentsAfter);
    }

    /**
     * Test add with patient not found clean method
     *
     * @return void
     */
    public function testAddWithPatientNotFound(): void
    {
        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
        $countEmployeesBefore = $this->employeesTable->find()->count();
        $countConsultingRoomsBefore = $this->consultingRoomsTable->find()->count();
        $countAppointmentsBefore = $this->appointmentsTable->find()->count();

        $data = [
            'patient_person_doc_type' => 'DNI',
            'patient_person_doc_num' => '78978979',
            'employee_person_doc_type' => 'DNI',
            'employee_person_doc_num' => '22222222',
            'consulting_room_id' => 1,
            'appointment_date' => FrozenDate::now(),
            'cost' => 50,
            'state' => 'PENDIENTE',
        ];

        $this->post('/api/appointments.json', $data);

        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
        $countEmployeesAfter = $this->employeesTable->find()->count();
        $countConsultingRoomsAfter = $this->consultingRoomsTable->find()->count();
        $countAppointmentsAfter = $this->appointmentsTable->find()->count();

        $this->assertResponseFailure();
        $this->assertResponseContains('"message": "La cita no fue registrada correctamente"');
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore, $countPatientsAfter);
        $this->assertEquals($countEmployeesBefore, $countEmployeesAfter);
        $this->assertEquals($countConsultingRoomsBefore, $countConsultingRoomsAfter);
        $this->assertEquals($countAppointmentsBefore, $countAppointmentsAfter);
    }

    /**
     * Test add with employee not found method
     *
     * @return void
     */
    public function testAddWithEmployeeNotFound(): void
    {
        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
        $countEmployeesBefore = $this->employeesTable->find()->count();
        $countConsultingRoomsBefore = $this->consultingRoomsTable->find()->count();
        $countAppointmentsBefore = $this->appointmentsTable->find()->count();

        $data = [
            'patient_person_doc_type' => 'DNI',
            'patient_person_doc_num' => '66666666',
            'employee_person_doc_type' => 'DNI',
            'employee_person_doc_num' => '56478547',
            'consulting_room_id' => 1,
            'appointment_date' => FrozenDate::now(),
            'cost' => 50,
            'state' => 'PENDIENTE',
        ];

        $this->post('/api/appointments.json', $data);

        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
        $countEmployeesAfter = $this->employeesTable->find()->count();
        $countConsultingRoomsAfter = $this->consultingRoomsTable->find()->count();
        $countAppointmentsAfter = $this->appointmentsTable->find()->count();

        $this->assertResponseFailure();
        $this->assertResponseContains('"message": "La cita no fue registrada correctamente"');
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore, $countPatientsAfter);
        $this->assertEquals($countEmployeesBefore, $countEmployeesAfter);
        $this->assertEquals($countConsultingRoomsBefore, $countConsultingRoomsAfter);
        $this->assertEquals($countAppointmentsBefore, $countAppointmentsAfter);
    }

    /**
     * Test add with consulting room not found method
     *
     * @return void
     */
    public function testAddWithConsultingRoomNotFound(): void
    {
        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
        $countEmployeesBefore = $this->employeesTable->find()->count();
        $countConsultingRoomsBefore = $this->consultingRoomsTable->find()->count();
        $countAppointmentsBefore = $this->appointmentsTable->find()->count();

        $data = [
            'patient_person_doc_type' => 'DNI',
            'patient_person_doc_num' => '66666666',
            'employee_person_doc_type' => 'DNI',
            'employee_person_doc_num' => '22222222',
            'consulting_room_id' => 18,
            'appointment_date' => FrozenDate::now(),
            'cost' => 50,
            'state' => 'PENDIENTE',
        ];

        $this->post('/api/appointments.json', $data);

        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
        $countEmployeesAfter = $this->employeesTable->find()->count();
        $countConsultingRoomsAfter = $this->consultingRoomsTable->find()->count();
        $countAppointmentsAfter = $this->appointmentsTable->find()->count();

        $this->assertResponseFailure();
        $this->assertResponseContains('"message": "La cita no fue registrada correctamente"');
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore, $countPatientsAfter);
        $this->assertEquals($countEmployeesBefore, $countEmployeesAfter);
        $this->assertEquals($countConsultingRoomsBefore, $countConsultingRoomsAfter);
        $this->assertEquals($countAppointmentsBefore, $countAppointmentsAfter);
    }

    /**
     * Test edit clean method
     *
     * @return void
     */
    public function testEditClean(): void
    {
        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
        $countEmployeesBefore = $this->employeesTable->find()->count();
        $countConsultingRoomsBefore = $this->consultingRoomsTable->find()->count();
        $countAppointmentsBefore = $this->appointmentsTable->find()->count();
        $appointmentBefore = $this->appointmentsTable->get(10);

        $consultingRoomsAvailables = array_diff(range(1, 10), [$appointmentBefore->consulting_room_id]);
        $consultingRoomIdNew = $consultingRoomsAvailables[array_rand($consultingRoomsAvailables)];
        $newCost = $appointmentBefore->cost + 2000;

        $data = [
            'employee_person_doc_type' => $appointmentBefore->employee_person_doc_type,
            'employee_person_doc_num' => $appointmentBefore->employee_person_doc_num,
            'consulting_room_id' => $consultingRoomIdNew,
            'appointment_date' => FrozenDate::now()->modify('+2 month'),
            'cost' => $newCost,
            'state' => 'PENDIENTE',
        ];

        $this->put('/api/appointments/10.json', $data);

        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
        $countEmployeesAfter = $this->employeesTable->find()->count();
        $countConsultingRoomsAfter = $this->consultingRoomsTable->find()->count();
        $countAppointmentsAfter = $this->appointmentsTable->find()->count();
        $appointmentAfter = $this->appointmentsTable->get(10);

        $this->assertResponseOk();
        $this->assertResponseContains('"message": "La cita fue modificada correctamente"');
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore, $countPatientsAfter);
        $this->assertEquals($countEmployeesBefore, $countEmployeesAfter);
        $this->assertEquals($countConsultingRoomsBefore, $countConsultingRoomsAfter);
        $this->assertEquals($countAppointmentsBefore, $countAppointmentsAfter);

        $this->assertNotEquals($appointmentBefore->consulting_room_id, $appointmentAfter->consulting_room_id);
        $this->assertEquals($appointmentAfter->consulting_room_id, $consultingRoomIdNew);

        $this->assertNotEquals($appointmentBefore->appointment_date, $appointmentAfter->appointment_date);
        $this->assertEquals($appointmentAfter->appointment_date, FrozenDate::now()->modify('+2 month'));

        $this->assertNotEquals($appointmentBefore->cost, $appointmentAfter->cost);
        $this->assertEquals($appointmentAfter->cost, $newCost);
    }

    /**
     * Test edit clean with another employee method
     *
     * @return void
     */
    public function testEditWithAnotherEmployeeClean(): void
    {
        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
        $countEmployeesBefore = $this->employeesTable->find()->count();
        $countConsultingRoomsBefore = $this->consultingRoomsTable->find()->count();
        $countAppointmentsBefore = $this->appointmentsTable->find()->count();
        $appointmentBefore = $this->appointmentsTable->get(10);

        $consultingRoomsAvailables = array_diff(range(1, 10), [$appointmentBefore->consulting_room_id]);
        $consultingRoomIdNew = $consultingRoomsAvailables[array_rand($consultingRoomsAvailables)];
        $newCost = $appointmentBefore->cost + 2000;

        $docNumsAvailables = array_diff(array_map(function($num) { return str_repeat(strval($num), 8);}, range(0, 4)), [$appointmentBefore->employee_person_doc_num]);
        $docNumNew = $docNumsAvailables[array_rand($docNumsAvailables)];
        $data = [
            'employee_person_doc_type' => 'DNI',
            'employee_person_doc_num' => $docNumNew,
            'consulting_room_id' => $consultingRoomIdNew,
            'appointment_date' => FrozenDate::now()->modify('+2 month'),
            'cost' => $newCost,
            'state' => 'PENDIENTE',
        ];

        $this->put('/api/appointments/10.json', $data);

        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
        $countEmployeesAfter = $this->employeesTable->find()->count();
        $countConsultingRoomsAfter = $this->consultingRoomsTable->find()->count();
        $countAppointmentsAfter = $this->appointmentsTable->find()->count();
        $appointmentAfter = $this->appointmentsTable->get(10);

        $this->assertResponseOk();
        $this->assertResponseContains('"message": "La cita fue modificada correctamente"');
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore, $countPatientsAfter);
        $this->assertEquals($countEmployeesBefore, $countEmployeesAfter);
        $this->assertEquals($countConsultingRoomsBefore, $countConsultingRoomsAfter);
        $this->assertEquals($countAppointmentsBefore, $countAppointmentsAfter);

        $this->assertNotEquals($appointmentBefore->consulting_room_id, $appointmentAfter->consulting_room_id);
        $this->assertEquals($appointmentAfter->consulting_room_id, $consultingRoomIdNew);

        $this->assertNotEquals($appointmentBefore->appointment_date, $appointmentAfter->appointment_date);
        $this->assertEquals($appointmentAfter->appointment_date, FrozenDate::now()->modify('+2 month'));

        $this->assertNotEquals($appointmentBefore->cost, $appointmentAfter->cost);
        $this->assertEquals($appointmentAfter->cost, $newCost);

        $this->assertNotEquals($appointmentBefore->employee_person_doc_num, $appointmentAfter->employee_person_doc_num);
        $this->assertEquals($appointmentAfter->employee_person_doc_num, $docNumNew);
    }

    /**
     * Test cancel method
     *
     * @return void
     */
    public function testCancel(): void
    {
        $appointmentId = $this->appointmentsTable->find()
            ->where(['state IN' => ['PENDIENTE', 'REPROGRAMADA']])
            ->first()
            ->get('id');

        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
        $countEmployeesBefore = $this->employeesTable->find()->count();
        $countConsultingRoomsBefore = $this->consultingRoomsTable->find()->count();
        $countAppointmentsBefore = $this->appointmentsTable->find()->count();
        $appointmentBefore = $this->appointmentsTable->get($appointmentId);

        $this->delete("/api/appointments/cancel/$appointmentId.json");

        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
        $countEmployeesAfter = $this->employeesTable->find()->count();
        $countConsultingRoomsAfter = $this->consultingRoomsTable->find()->count();
        $countAppointmentsAfter = $this->appointmentsTable->find()->count();
        $appointmentAfter = $this->appointmentsTable->get($appointmentId);

        $this->assertResponseOk();
        $this->assertResponseContains('"message": "La cita fue cancelada correctamente"');
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore, $countPatientsAfter);
        $this->assertEquals($countEmployeesBefore, $countEmployeesAfter);
        $this->assertEquals($countConsultingRoomsBefore, $countConsultingRoomsAfter);
        $this->assertEquals($countAppointmentsBefore, $countAppointmentsAfter);

        $this->assertNotEquals($appointmentBefore->cancel_date, $appointmentAfter->cancel_date);
        $this->assertEquals($appointmentAfter->cancel_date->format('Y-m-d'), FrozenTime::now()->format('Y-m-d'));

        $this->assertNotEquals($appointmentBefore->state, $appointmentAfter->state);
        $this->assertEquals($appointmentAfter->state, 'CANCELADA');
    }

    /**
     * Test undo cancel method
     *
     * @return void
     */
    public function testUndoCancel(): void
    {
        $appointmentId = $this->appointmentsTable->find()
            ->where(['state' => 'CANCELADA'])
            ->first()
            ->get('id');

        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
        $countEmployeesBefore = $this->employeesTable->find()->count();
        $countConsultingRoomsBefore = $this->consultingRoomsTable->find()->count();
        $countAppointmentsBefore = $this->appointmentsTable->find()->count();
        $appointmentBefore = $this->appointmentsTable->get($appointmentId);

        $this->put("/api/appointments/undo_cancel/$appointmentId.json");

        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
        $countEmployeesAfter = $this->employeesTable->find()->count();
        $countConsultingRoomsAfter = $this->consultingRoomsTable->find()->count();
        $countAppointmentsAfter = $this->appointmentsTable->find()->count();
        $appointmentAfter = $this->appointmentsTable->get($appointmentId);

        $this->assertResponseOk();
        $this->assertResponseContains("\"message\": \"Se anul\u00f3 la cancelaci\u00f3n de la cita correctamente\"");
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore, $countPatientsAfter);
        $this->assertEquals($countEmployeesBefore, $countEmployeesAfter);
        $this->assertEquals($countConsultingRoomsBefore, $countConsultingRoomsAfter);
        $this->assertEquals($countAppointmentsBefore, $countAppointmentsAfter);

        $this->assertNotEquals($appointmentBefore->cancel_date, $appointmentAfter->cancel_date);
        $this->assertEquals($appointmentAfter->cancel_date, null);

        $this->assertNotEquals($appointmentBefore->state, $appointmentAfter->state);
        $this->assertEquals($appointmentAfter->state, 'PENDIENTE');
    }

    /**
     * Test reschedule method
     *
     * @return void
     */
    public function testReschedule(): void
    {
        $appointmentId = $this->appointmentsTable->find()
            ->where(['state' => 'PENDIENTE'])
            ->first()
            ->get('id');

        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
        $countEmployeesBefore = $this->employeesTable->find()->count();
        $countConsultingRoomsBefore = $this->consultingRoomsTable->find()->count();
        $countAppointmentsBefore = $this->appointmentsTable->find()->count();
        $appointmentBefore = $this->appointmentsTable->get($appointmentId);

        $data = [
            'appointment_date' => FrozenDate::now()->modify('+3 month'),
        ];

        $this->put("/api/appointments/reschedule/$appointmentId.json", $data);

        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
        $countEmployeesAfter = $this->employeesTable->find()->count();
        $countConsultingRoomsAfter = $this->consultingRoomsTable->find()->count();
        $countAppointmentsAfter = $this->appointmentsTable->find()->count();
        $appointmentAfter = $this->appointmentsTable->get($appointmentId);

        $this->assertResponseOk();
        $this->assertResponseContains('"message": "La cita fue reprogramada correctamente"');
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore, $countPatientsAfter);
        $this->assertEquals($countEmployeesBefore, $countEmployeesAfter);
        $this->assertEquals($countConsultingRoomsBefore, $countConsultingRoomsAfter);
        $this->assertEquals($countAppointmentsBefore, $countAppointmentsAfter);

        $this->assertNotEquals($appointmentBefore->appointment_date, $appointmentAfter->appointment_date);
        $this->assertEquals($appointmentAfter->appointment_date, FrozenDate::now()->modify('+3 month'));

        $this->assertNotEquals($appointmentBefore->state, $appointmentAfter->state);
        $this->assertEquals($appointmentAfter->state, 'REPROGRAMADA');
    }

    /**
     * Test attend method
     *
     * @return void
     */
    public function testAttend(): void
    {
        $appointmentId = $this->appointmentsTable->find()
            ->where(['state IN' => ['PENDIENTE', 'REPROGRAMADA']])
            ->first()
            ->get('id');

        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
        $countEmployeesBefore = $this->employeesTable->find()->count();
        $countConsultingRoomsBefore = $this->consultingRoomsTable->find()->count();
        $countAppointmentsBefore = $this->appointmentsTable->find()->count();
        $appointmentBefore = $this->appointmentsTable->get($appointmentId, ['contain' => ['Diseases']]);
        $countMedicinesBefore = $this->appointmentsTable->find()->count();
        $countRecipesBefore = $this->recipesTable->find()->count();
        $countDiseasesBefore = $this->diseasesTable->find()->count();
        $countDiagnosticsBefore = $this->diagnosticsTable->find()->count();

        $data = [
            'diseases' => [
                '_ids' => [1, 2, 3, 4],
            ],
            'recipes' => [[
                    'medicine_id' => 1,
                    'amount' => 30,
                    'days' => 10,
                    'prescription' => 'una por la mañana',
                ], [
                    'medicine_id' => 2,
                    'amount' => 15,
                    'days' => 85,
                    'prescription' => 'dos por la mañana',
                ], [
                    'medicine_id' => 3,
                    'amount' => 12,
                    'days' => 10,
                    'prescription' => 'mitad por la mañana',
                ],
            ],
        ];
        $this->put("/api/appointments/attend/$appointmentId.json", $data);

        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
        $countEmployeesAfter = $this->employeesTable->find()->count();
        $countConsultingRoomsAfter = $this->consultingRoomsTable->find()->count();
        $countAppointmentsAfter = $this->appointmentsTable->find()->count();
        $appointmentAfter = $this->appointmentsTable->get($appointmentId, ['contain' => ['Diseases']]);
        $countMedicinesAfter = $this->appointmentsTable->find()->count();
        $countRecipesAfter = $this->recipesTable->find()->count();
        $countDiseasesAfter = $this->diseasesTable->find()->count();
        $countDiagnosticsAfter = $this->diagnosticsTable->find()->count();

        $this->assertResponseOk();
        $this->assertResponseContains("\"message\": \"Se registr\u00f3 la atenci\u00f3n correctamente");
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore, $countPatientsAfter);
        $this->assertEquals($countEmployeesBefore, $countEmployeesAfter);
        $this->assertEquals($countConsultingRoomsBefore, $countConsultingRoomsAfter);
        $this->assertEquals($countAppointmentsBefore, $countAppointmentsAfter);
        $this->assertEquals($countMedicinesBefore, $countMedicinesAfter);
        $this->assertEquals($countRecipesBefore + 3, $countRecipesAfter);
        $this->assertEquals($countDiseasesBefore, $countDiseasesAfter);
        $this->assertEquals($countDiagnosticsBefore + 4, $countDiagnosticsAfter);

        $this->assertNotEquals($appointmentBefore->state, $appointmentAfter->state);
        $this->assertEquals($appointmentAfter->state, 'TERMINADA');
    }
}
