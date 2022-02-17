<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\PatientsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\I18n\FrozenDate;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\PatientsController Test Case
 *
 * @uses \App\Controller\PatientsController
 */
class PatientsControllerTest extends TestCase
{
    use IntegrationTestTrait;
    private $peopleTable;
    private $patientsTable;
    
    public function getFixtures(): array {
        $this->addFixture('app.People')
            ->addFixture('app.Patients')
            ->addFixture('app.Users');
        
        return parent::getFixtures();
    }
    
    public function setUp(): void {
        parent::setUp();
        $this->configRequest([
            'headers' => ['Accept' => 'application/json']
        ]);
        $data = [
            "username" => "70801887",
            "password" => "70801887"
        ];
        $this->post('/api/users/login.json', $data);
        $token = json_decode((string)$this->_response->getBody(), true)["token"];
        $this->configRequest([
            'headers' => [
                'Authorization' => "Bearer $token"
            ]
        ]);
        
        $this->peopleTable = TableRegistry::getTableLocator()->get('People');
        $this->patientsTable = TableRegistry::getTableLocator()->get('Patients');
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void {
        $this->get('/api/patients.json');
        $this->assertResponseOk();
        $this->assertResponseContains("\"count\": 11");
    }
    
    /**
     * Test index with filters method
     *
     * @return void
     */
    public function testIndexWithFilters(): void {
        $this->get('/api/patients.json?state=ACTIVO&person_doc_type=DNI');
        $this->assertResponseOk();
        $this->assertResponseContains("\"count\": 5");
    }
    
    /**
     * Test View method
     *
     * @return void
     */
    public function testView(): void {
        $this->get('/api/patients/DNI/55555555.json');
        $this->assertResponseOk();
        $this->assertResponseContains("\"person\": {\n");
        $this->assertResponseContains("\"doc_num\": \"55555555\"");
    }
    
    /**
     * Test add clean method
     *
     * @return void
     */
    public function testAddClean(): void {
        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
     
        $data = [
            'state' => 'ACTIVO',
            'person' => [
                'doc_type' => 'DNI',
                'doc_num' => '70801887',
                'names' => 'Roberto',
                'last_name1' => 'Bocanegra',
                'last_name2' => 'Palacios',
                'birth' => FrozenDate::now(),
                'nationality' => 'PERÚ',
                'gendre' => 'M',
            ]
        ];
        
        $this->post('/api/patients.json', $data);
        
        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
                
        $this->assertResponseOk();
        $this->assertResponseContains("\"message\": \"El paciente fue registrado correctamente\"");
        $this->assertEquals($countPeopleBefore + 1, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore + 1, $countPatientsAfter);
    }
    
    /**
     * Test add with person repeated method
     *
     * @return void
     */
    public function testAddWithPersonRepeated(): void {
        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
        
        $data = [
            'created' => FrozenDate::now(),
            'state' => 'ACTIVO',
            'person' => [
                'doc_type' => 'DNI',
                'doc_num' => '11111111',
                'names' => 'Roberto',
                'last_name1' => 'Bocanegra',
                'last_name2' => 'Palacios',
                'birth' => FrozenDate::now(),
                'nationality' => 'PERÚ',
                'created' => FrozenDate::now(),
                'gendre' => 'M',
            ]
        ];
        
        $this->post('/api/patients.json', $data);
        
        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
        
        $this->assertResponseOk();
        $this->assertResponseContains("\"message\": \"El paciente fue registrado correctamente\"");
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore + 1, $countPatientsAfter);
    }
    
    /**
     * Test add with person and patient repeated method
     *
     * @return void
     */
    public function testAddWithPersonAndPatientRepeated(): void {
        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
        $personBefore = $this->peopleTable->get(['DNI', '99999999']);
        
        $data = [
            'created' => FrozenDate::now(),
            'state' => 'ACTIVO',
            'person' => [
                'doc_type' => 'DNI',
                'doc_num' => '99999999',
                'names' => 'Roberto',
                'last_name1' => 'Bocanegra',
                'last_name2' => 'Palacios',
                'birth' => FrozenDate::now(),
                'nationality' => 'PERÚ',
                'created' => FrozenDate::now(),
                'gendre' => 'M',
            ]
        ];
        
        $this->post('/api/patients.json', $data);
        
        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
        $personAfter = $this->peopleTable->get(['DNI', '99999999']);
        
        $this->assertResponseFailure();
        $this->assertResponseContains("\"message\": \"El paciente no fue registrado correctamente\"");
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore, $countPatientsAfter);
        $this->assertEquals($personBefore->names, $personAfter->names);
        $this->assertNotEquals($personAfter->names, 'Roberto');
    }
    
    /**
     * Test edit clean method
     *
     * @return void
     */
    public function testEditClean(): void {
        $countPeopleBefore = $this->peopleTable->find()->count();
        $countPatientsBefore = $this->patientsTable->find()->count();
        $patientBefore = $this->patientsTable->get(['DNI', '88888888'], ['contain' => ['People']]);
                
        $data = [
            'person' => [
                'doc_type' => 'DNI',
                'doc_num' => '88888888',
                'names' => 'Rigoberto Juan',
                'last_name1' => 'Bocanegra',
                'last_name2' => 'Palacios',
                'birth' => FrozenDate::now(),
                'nationality' => 'PERÚ',
                'gendre' => 'M',
            ]
        ];
        
        $this->put('/api/patients/update/DNI/88888888.json', $data);
        
        $countPeopleAfter = $this->peopleTable->find()->count();
        $countPatientsAfter = $this->patientsTable->find()->count();
        $patientAfter = $this->patientsTable->get(['DNI', '88888888'], ['contain' => ['People']]);
                
        $this->assertResponseOk();
        $this->assertResponseContains("\"message\": \"El paciente fue modificado correctamente\"");
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countPatientsBefore, $countPatientsAfter);
        $this->assertNotEquals($patientBefore->person->names, $patientAfter->person->names);
        $this->assertEquals($patientAfter->person->names, 'Rigoberto Juan');
    }
    
    /**
     * Test enable method
     *
     * @return void
     */
    public function testEnable(): void {
        $statePatientBefore = $this->patientsTable->get(['DNI', '87654321'])->state;
        
        $data = [
            'person_doc_type' => 'DNI',
            'person_doc_num' => '87654321'
        ];
        
        $this->post('/api/patients/enable.json', $data);
        
        $statePatientAfter = $this->patientsTable->get(['DNI', '87654321'])->state;

        $this->assertResponseOk();
        $this->assertResponseContains("\"message\": \"El paciente fue habilitado correctamente\"");
        $this->assertEquals($statePatientBefore, 'INACTIVO');
        $this->assertEquals($statePatientAfter, 'ACTIVO');
    }
    
    /**
     * Test disable method
     *
     * @return void
     */
    public function testDisable(): void {
        $statePatientBefore = $this->patientsTable->get(['DNI', '99999999'])->state;
        
        $data = [
            'person_doc_type' => 'DNI',
            'person_doc_num' => '99999999'
        ];
        
        $this->post('/api/patients/disable.json', $data);
        
        $statePatientAfter = $this->patientsTable->get(['DNI', '99999999'])->state;

        $this->assertResponseOk();
        $this->assertResponseContains("\"message\": \"El paciente fue deshabilitado correctamente\"");
        $this->assertEquals($statePatientBefore, 'ACTIVO');
        $this->assertEquals($statePatientAfter, 'INACTIVO');
    }
}
