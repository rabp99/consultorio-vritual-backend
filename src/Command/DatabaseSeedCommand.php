<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;

class DatabaseSeedCommand extends Command
{
    /**
     * Execute method Seed database
     *
     * @param \Cake\Console\Arguments $args Arguments instance.
     * @param \Cake\Console\ConsoleIo $io ConsoleIo instance.
     * @return void
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
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
        exec('bin\cake migrations seed --seed CittsSeed');
        exec('bin\cake migrations seed --seed ImagingExamsSeed');
        exec('bin\cake migrations seed --seed LaboratoryExamsSeed');
        exec('bin\cake migrations seed --seed AppointmentsImagingExamsSeed');
        exec('bin\cake migrations seed --seed AppointmentsLaboratoryExamsSeed');
        
        $io->out('¡Seed Completo!');
    }
}
