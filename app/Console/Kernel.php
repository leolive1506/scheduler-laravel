<?php

namespace App\Console;

use App\Actions\DeleteOldLogs;
use App\Jobs\MyFirstJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(new DeleteOldLogs())->everyMinute();
        $schedule->command('dev')->everyMinute();
        $schedule->job(new MyFirstJob())->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
