<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;

class DatabaseSeedCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io) {
        exec('bin\cake migrations seed --seed UsersSeed');
        exec('bin\cake migrations seed --seed PeopleSeed');
        exec('bin\cake migrations seed --seed PlacesSeed');
        exec('bin\cake migrations seed --seed ConsultingRoomsSeed');
        exec('bin\cake migrations seed --seed PatientsSeed');
        exec('bin\cake migrations seed --seed EmployeesSeed');
        exec('bin\cake migrations seed --seed EmployeeRecordsSeed');
        exec('bin\cake migrations seed --seed AppointmentsSeed');
        exec('bin\cake migrations seed --seed DiseasesSeed');
        exec('bin\cake migrations seed --seed DiagnosticsSeed');
        exec('bin\cake migrations seed --seed MedicinesSeed');
        exec('bin\cake migrations seed --seed RecipesSeed');
        
        $io->out("¡Seed Completo!");
    }
}