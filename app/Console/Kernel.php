<?php

namespace App\Console;

use App\Console\Commands\SampleCommand;
use App\Console\Commands\BackupDatabase; // Ensure this is included
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        BackupDatabase::class,
        SampleCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('db:backup --force')->everyMinute(); // Using everyMinute() instead of everySecond() is a good practice.
        Log::info('kernel here');
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
