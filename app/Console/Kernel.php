<?php

namespace App\Console;

use App\Console\Commands\FixAltPhoto;
use App\Console\Commands\UpdateMinAndMaxGradeCross;
use App\Console\Commands\UpdateMinAndMaxGradeRoute;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\FixLowerGrade;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        FixLowerGrade::class,
        FixAltPhoto::class,
        UpdateMinAndMaxGradeRoute::class,
        UpdateMinAndMaxGradeCross::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
