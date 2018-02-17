<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Recove\PathDownload;
use App\Qore\Company;

class CopyFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:copy';

    /**
     * The console command description.
     *n
     * @var string
     */
    protected $description = 'Copia de archivos';

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
        $companies = Company::where('name', 'Vitechmex')->get();
        foreach($companies as $company)
        {
            $path = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/clientes/ftp/'.$company->name;
            PathDownload::readDirs($path, $company->id);
        }        
    }



}