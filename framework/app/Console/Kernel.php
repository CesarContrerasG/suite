<?php



namespace App\Console;



use Illuminate\Console\Scheduling\Schedule;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Console\Commands\GenerateInvoice;



class Kernel extends ConsoleKernel

{

    /**

     * The Artisan commands provided by your application.

     *

     * @var array

     */

    protected $commands = [
        'App\Console\Commands\RecoverEdocument',
        GenerateInvoice::class,      
         'App\Console\Commands\RecoverAuto',
        'App\Console\Commands\CopyFiles'



    ];



    /**

     * Define the application's command schedule.

     *

     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule

     * @return void

     */

    protected function schedule(Schedule $schedule)

    {

        $schedule->command('invoice:create')

            ->daily()

            ->timezone('Mexico/General')

            ->at('05:00');

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
