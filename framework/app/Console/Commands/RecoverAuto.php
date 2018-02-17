<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Qore\Company;

class RecoverAuto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:autorecover';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recuperación  de pedimentos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {    
        $configuration = \DB::connection('mysql')->table('config_auto')->get();
        foreach($configuration as $config)
        {
            echo $config->company;
            
            //$company = Company::find($config->company);
            /*\DB::disconnect('companies');
            $connection = [
                'driver' => 'mysql',
                'host' => env('DB_HOST', 'localhost'),
                'port' => env('DB_PORT', '3306'),
                'database' =>  $company->db,
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
                'strict' => true,
                'engine' => null,
            ];
        
            config(['database.connections.companies' => $connection]);
            \DB::setDefaultConnection('companies');*/
            $job = (new \App\Jobs\RecoverAll($config))->onQueue($config->company);
            dispatch($job);
            // echo \DB::getDefaultConnection();
            //\Queue::connection('database')->pushOn($config->company, $job);
            
        }       
  		
    }

}
