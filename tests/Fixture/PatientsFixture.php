<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;
use Faker\Factory;
use Cake\I18n\FrozenDate;

/**
 * PatientsFixture
 */
class PatientsFixture extends TestFixture
{
    public $import = ['table' => 'patients'];
    
    public function init(): void {
        $faker = Factory::create("es_PE");
        $this->records = [];
        
        for ($i = 5; $i < 10; $i++) {
            $this->records[] = [
                'person_doc_type' => 'DNI',
                'person_doc_num' => str_repeat(strval($i), 8),
                'created' => FrozenDate::now(),
                'state' => 'ACTIVO'
            ];
        }

        for ($i = 5; $i < 10; $i++) {
            $this->records[] = [
                'person_doc_type' => 'CEX',
                'person_doc_num' => str_repeat(strval($i), 8),
                'created' => FrozenDate::now(),
                'state' => 'ACTIVO'
            ];
        }
        
        $this->records[] = [
            'person_doc_type' => 'DNI',
            'person_doc_num' => '87654321',
            'created' => FrozenDate::now(),
            'state' => 'INACTIVO'
        ];
        
        parent::init();
    }
}
