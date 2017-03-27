<?php

namespace FEMR\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();

        $date = Carbon::now()->toW3cString();
        $environment = env('APP_ENV');
        $schedule->command(
            "db:backup --database=mysql --destination=dropbox --destinationPath=/{$environment}/projectname_{$environment}_{$date} --compression=gzip"
        )->daily();
    }
}
