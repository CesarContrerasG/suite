<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Recove\ED;
use App\Recove\SealED;
use App\User;
use App\Qore\Company;

class RecoverEdocument extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:recover';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recuperación  de Archivos Digitalizados-ED';

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
        $path = dirname(dirname(dirname(dirname(__FILE__)))).'/storage/xml/edocument/';
        $edocument = \DB::connection('mysql')->table('bitacora_ED')->where('status',0)->get();
        foreach ($edocument as $dig) 
        {
        	$company = Company::find($dig->company_id);
        	$this->changeConnection($company->db);
        	$path_my_ftp = dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/public_html/clientes/ftp/'.$company->name.'/pdf/'.$dig->period.'/'.$dig->reference.'/'; 
		        if (!file_exists($path_my_ftp)) {
				    @mkdir($path_my_ftp);
				}
				
        	$seals = SealED::where('pk_emp',$company->name)->first();
        	
        	$xml_envio_edo = ED::generarXML($path, $seals, $dig->edocument);
            $resp_consulta = $path."resp_" . $dig->edocument.".xml";   
            
            $envio_consulta = "curl -o " . $resp_consulta . " -k -H " . '"' ."Content-Type: text/xml; charset=utf-8" . '"' . " -H " . '"' ."SOAPAction:http://tempuri.org/IServicioEdocument/GetDocumento" . '"' . " -d @" . $path.$xml_envio_edo . " https://www.ventanillaunica.gob.mx/Ventanilla-HA/ServicioEdocument/ServicioEdocument.svc";
            //$exist_consulta = ED::where('edocument', $dig->edocument)->count();
            //echo file_exists($resp_consulta);
            /*if(!file_exists($resp_consulta))
            	exec($envio_consulta);*/
            echo $dig->edocument;
            $xml_leer = ED::leerXML($resp_consulta,$dig->edocument,$company,$dig->reference,$dig->period);
 			
            if($xml_leer['status'] == 1)
		    {
	        	
                $site_ftp = \DB::connection('mysql')->table('config_dir')->where('company',$company->name)->count();
     
		        if($site_ftp > 0)
		        {
		            $path_ftp = 'pdf/'.$dig->period.'/'.$dig->reference.'/'; 
		            $this->getFTPPath($company->name,$path_my_ftp.$xml_leer['file'],$path_ftp,$xml_leer['file']);
		        }
                
		        $file_acuse = ED::crearAcuse($dig->edocument,$dig->reference, $dig->period, $company->name);

		        if($site_ftp > 0)
		        {
		            $path_ftp = 'pdf/'.$dig->period.'/'.$dig->reference.'/';
		            $new_file = $dig->reference.'_Acuse_'.$dig->edocument.'.pdf'; 
		            $this->getFTPPath($company->name,$file_acuse,$path_ftp,$new_file);
		        }
		        \DB::connection('mysql')->table('bitacora_ED')->where('edocument',$dig->edocument)->update(['status'=>1]);
		    }
		    else
		    {
                $mensaje = 'Le informamos  que el  horario para poder generar consultas es de 22:00 p.m. a las 08:00 a.m.';
		        if($xml_leer['status'] == 2 && $xml_leer['error'] != $mensaje)
                {
		        	$observa = $xml_leer['error'];
                    $status = $xml_leer['status'];
                }
		        else
                {
		        	$observa = 'Pendiente por recuperar';
                    $status = 0;
                }
	            \DB::connection('mysql')->table('bitacora_ED')->where('edocument',$dig->edocument)->update(['observation'=>$observa,'status' => $status]);
	        }
            unlink($path.$xml_envio_edo);
	        
        }
    }

    public function changeConnection($db)
    {
    	$connection = [
                'driver' => 'mysql',
                'host' => env('DB_HOST', 'localhost'),
                'port' => env('DB_PORT', '3306'),
                'database' =>  $db,
                'username' => 'secenet',
                'password' => 'adc1e991995f4e2e',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
                'strict' => true,
                'engine' => null,
            ];
        
        config(['database.connections.default' => $connection]);
        \DB::setDefaultConnection('default');
    }

    public function getFTPPath($emp, $file, $path_ftp, $new_file)
    {
        $data_ftp = \DB::connection('mysql')->table('config_dir')->where('company',$emp)->first();       
        $ftp_server = $data_ftp->ftp;
        $ftp_username   = $data_ftp->user;
        $ftp_password   =  $data_ftp->password;  

        $conn_id = @ftp_connect($ftp_server);
        if (@ftp_login($conn_id, $ftp_username, $ftp_password))
            $connect = $conn_id;
        else
            $connect = false;

        if($connect != false)
        {
            
            @ftp_chdir($conn_id, '/');
            $parts = explode('/',$path_ftp);
            foreach($parts as $part){
                if(!@ftp_chdir($conn_id, $part)){
                ftp_mkdir($conn_id, $part);
                ftp_chdir($conn_id, $part);
                }
            }   
       		
            ftp_put($conn_id, $path_ftp.$new_file,$file, FTP_BINARY);           
            ftp_close($conn_id);
        }
             
    }
}
