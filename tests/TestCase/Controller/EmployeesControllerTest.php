<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\EmployeesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\I18n\FrozenDate;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\EmployeesController Test Case
 *
 * @uses \App\Controller\EmployeesController
 */
class EmployeesControllerTest extends TestCase
{
    use IntegrationTestTrait;
    private $peopleTable;
    private $employeesTable;
    private $employeeRecordsTable;
    
    public function getFixtures(): array {
        $this->addFixture('app.People')
            ->addFixture('app.Employees')
            ->addFixture('app.EmployeeRecords')
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
        $this->employeesTable = TableRegistry::getTableLocator()->get('Employees');
        $this->employeeRecordsTable = TableRegistry::getTableLocator()->get('EmployeeRecords');
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void {
        $this->get('/api/employees.json');
        $this->assertResponseOk();
        $this->assertResponseContains("\"count\": 11");
    }
    
    /**
     * Test index with filters method
     *
     * @return void
     */
    public function testIndexWithFilters(): void {
        $this->get('/api/employees.json?state=ACTIVO&person_doc_type=DNI');
        $this->assertResponseOk();
        $this->assertResponseContains("\"count\": 5");
    }
    
    /**
     * Test add clean method
     *
     * @return void
     */
    public function testAddClean(): void {
        $countPeopleBefore = $this->peopleTable->find()->count();
        $countEmployeesBefore = $this->employeesTable->find()->count();
        $countEmployeeRecordsBefore = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '70801887',
            ])
            ->count();
        
        $data = [
            'cmp' => '450847',
            'created' => FrozenDate::now(),
            'state' => 'ACTIVO',
            'person' => [
                'doc_type' => 'DNI',
                'doc_num' => '70801887',
                'names' => 'Roberto',
                'last_name1' => 'Bocanegra',
                'last_name2' => 'Palacios',
                'birth' => FrozenDate::now(),
                'nationality' => 'PERÚ',
                'created' => FrozenDate::now(),
                'gendre' => 'M',
            ],
            'employee_records' => [
                [
                    'start' => FrozenDate::now()
                ]
            ]
        ];
        
        $this->post('/api/employees.json', $data);
        
        $countPeopleAfter = $this->peopleTable->find()->count();
        $countEmployeesAfter = $this->employeesTable->find()->count();
        $countEmployeeRecordsAfter = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '70801887',
            ])
            ->count();
                
        $this->assertResponseOk();
        $this->assertResponseContains("\"message\": \"El m\u00e9dico fue registrado correctamente\"");
        $this->assertEquals($countPeopleBefore + 1, $countPeopleAfter);
        $this->assertEquals($countEmployeesBefore + 1, $countEmployeesAfter);
        $this->assertEquals($countEmployeeRecordsBefore + 1, $countEmployeeRecordsAfter);
    }
    
    /**
     * Test add with person repeated method
     *
     * @return void
     */
    public function testAddWithPersonRepeated(): void {
        $countPeopleBefore = $this->peopleTable->find()->count();
        $countEmployeesBefore = $this->employeesTable->find()->count();
        $countEmployeeRecordsBefore = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '99999999',
            ])
            ->count();
        
        $data = [
            'cmp' => '450847',
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
            ],
            'employee_records' => [
                [
                    'start' => FrozenDate::now()
                ]
            ]
        ];
        
        $this->post('/api/employees.json', $data);
        
        $countPeopleAfter = $this->peopleTable->find()->count();
        $countEmployeesAfter = $this->employeesTable->find()->count();
        $countEmployeeRecordsAfter = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '99999999',
            ])
            ->count();
        
        $this->assertResponseOk();
        $this->assertResponseContains("\"message\": \"El m\u00e9dico fue registrado correctamente\"");
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countEmployeesBefore + 1, $countEmployeesAfter);
        $this->assertEquals($countEmployeeRecordsBefore + 1, $countEmployeeRecordsAfter);
    }
    
    /**
     * Test add with person and employee repeated method
     *
     * @return void
     */
    public function testAddWithPersonAndEmployeeRepeated(): void {
        $countPeopleBefore = $this->peopleTable->find()->count();
        $countEmployeesBefore = $this->employeesTable->find()->count();
        $countEmployeeRecordsBefore = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '11111111',
            ])
            ->count();
        
        $data = [
            'cmp' => '450847',
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
            ],
            'employee_records' => [
                [
                    'start' => FrozenDate::now()
                ]
            ]
        ];
        
        $this->post('/api/employees.json', $data);
        
        $countPeopleAfter = $this->peopleTable->find()->count();
        $countEmployeesAfter = $this->employeesTable->find()->count();
        $countEmployeeRecordsAfter = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '11111111',
            ])
            ->count();
        
        $this->assertResponseFailure();
        $this->assertResponseContains("\"message\": \"El m\u00e9dico no fue registrado correctamente\"");
        $this->assertEquals($countPeopleBefore, $countPeopleAfter);
        $this->assertEquals($countEmployeesBefore, $countEmployeesAfter);
        $this->assertEquals($countEmployeeRecordsBefore, $countEmployeeRecordsAfter);
    }
     
    /**
     * Test enable method
     *
     * @return void
     */
    public function testEnable(): void {
        $countEmployeeRecordsBefore = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '12345678',
            ])
            ->count();
        
        $lastEmployeeRecordsBefore = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '12345678',
            ])
            ->order(["EmployeeRecords.start" => "DESC"])
            ->first();
        $stateEmployeeBefore = $this->employeesTable->get(['DNI', '12345678'])->state;
        
        $data = [
            'person_doc_type' => 'DNI',
            'person_doc_num' => '12345678',
            'start' => FrozenDate::now()->modify('+ 2days')
        ];
        
        $this->post('/api/employees/enable.json', $data);
        
        $countEmployeeRecordsAfter = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '12345678',
            ])
            ->count();
        $lastEmployeeRecordsAfter = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '12345678',
            ])
            ->order(["EmployeeRecords.start" => "DESC"])
            ->first();
        $stateEmployeeAfter = $this->employeesTable->get(['DNI', '12345678'])->state;

        $this->assertResponseOk();
        $this->assertResponseContains("\"message\": \"El m\u00e9dico fue habilitado correctamente\"");
        $this->assertEquals($countEmployeeRecordsBefore + 1, $countEmployeeRecordsAfter);
        $this->assertEquals($lastEmployeeRecordsBefore->end, FrozenDate::now());
        $this->assertEquals($lastEmployeeRecordsAfter->end, null);
        $this->assertEquals($stateEmployeeBefore, 'INACTIVO');
        $this->assertEquals($stateEmployeeAfter, 'ACTIVO');
    }
    
    /**
     * Test disable method
     *
     * @return void
     */
    public function testDisable(): void {
        $countEmployeeRecordsBefore = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '11111111',
            ])
            ->count();
        $lastEmployeeRecordsBefore = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '11111111',
            ])
            ->order(["EmployeeRecords.start" => "DESC"])
            ->first();
        $stateEmployeeBefore = $this->employeesTable->get(['DNI', '11111111'])->state;
        
        $data = [
            'person_doc_type' => 'DNI',
            'person_doc_num' => '11111111',
            'end' => new FrozenDate('2021-01-31')
        ];
        
        $this->post('/api/employees/disable.json', $data);
        
        $countEmployeeRecordsAfter = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '11111111',
            ])
            ->count();
        $lastEmployeeRecordsAfter = $this->employeeRecordsTable->find()
            ->where([
                'EmployeeRecords.employee_person_doc_type' => 'DNI',
                'EmployeeRecords.employee_person_doc_num' => '11111111',
            ])
            ->order(["EmployeeRecords.start" => "DESC"])
            ->first();
        $stateEmployeeAfter = $this->employeesTable->get(['DNI', '11111111'])->state;

        $this->assertResponseOk();
        $this->assertResponseContains("\"message\": \"El m\u00e9dico fue deshabilitado correctamente\"");
        $this->assertEquals($countEmployeeRecordsBefore, $countEmployeeRecordsAfter);
        $this->assertEquals($lastEmployeeRecordsBefore->end, null);
        $this->assertEquals($lastEmployeeRecordsAfter->end, new FrozenDate('2021-01-31'));
        $this->assertEquals($stateEmployeeBefore, 'ACTIVO');
        $this->assertEquals($stateEmployeeAfter, 'INACTIVO');
    }
}
