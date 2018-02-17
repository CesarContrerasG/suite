<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Qore\Company;
use App\Recove\PedimentoPrueba;
use App\Recove\BitacoraPedimento;
use App\Recove\BitacoraCove;
use App\Recove\ConsultaCovePrueba;
use App\Recove\ItemPrueba;

class RecoverAll implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $company;
    protected $aduanas;
    protected $type;
    protected $last_date;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($config)
    {
        $this->company = $config->company;
        $this->aduanas = $config->aduanas;
        $this->type = $config->type;
        $this->last_date = $config->last_date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $company = Company::find($this->company);
        $connection = [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '3306'),
            'database' =>  $company->db,
            'username' => 'secenet',
            'password' => 'adc1e991995f4e2e',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ];
        config(['database.connections.'.$company->name => $connection]);
        \DB::setDefaultConnection($company->name);
        $list_aduanas = explode(',', $this->aduanas);
        $first_date = date("Y-m-d", strtotime($this->last_date ."+ 1 days"));
        
        if($this->type == 1)
            $finish_date = $first_date;
        if($this->type == 2)
            $finish_date = date("Y-m-d", strtotime($first_date ."+ 6 days"));
        if($this->type == 3)
            $finish_date = date("Y-m-d", strtotime($first_date ."+ 1 month"));
   
        $start = microtime(true);
        for($i=0; $i<count($list_aduanas); $i++)
        {
            $aduana = $list_aduanas[$i];

            //========================== RECORRER RANGO DE FECHAS POR DIA ==================================
            for($f=$first_date; $f<=$finish_date; $f = date("Y-m-d", strtotime($f ."+ 1 days")))
            {
                PedimentoPrueba::searchList($aduana, $f, $start, $company->rfc, $company->name); 
                
                \DB::connection('mysql')->table('config_auto')->where('company', $this->company)->update(['last_date' => $f]);
            }            
        }
        /*
        $bitacora = BitacoraPedimento::where('status', '!=', 2)->get(); 
        foreach ($bitacora as $bit) 
        {				
            $status = 3;
            $observaciones = '';
            
            if($bit->status == 0)
            {
                $response = PedimentoPrueba::requestCompleteXML($bit, $company->name);
                if($response != 0)
                {
                    $result = PedimentoPrueba::fillData($response,$bit->aduana, $bit->patente, $bit->pedimento, $bit->id, $this->company);   
                    echo vard_dump($result);          
                    $status = $result['status'];
                    $observaciones = $result['observaciones'];
                }
            }            
			if($bit->status == 1)
			{
				for($i=1; $i <= $bit->tpartidas; $i++)			
					PedimentoPrueba::consultaPartida($i, $bit->id, $bit->aduana, $bit->patente, $bit->pedimento, $bit->operacion, $this->company);

				$referen = $bit->aduana.'-'.$bit->patente.'-'.$bit->pedimento;
				$toptr03 = ItemPrueba::where('pk_referencia', $referen)->count();	
				if($bit->tpartidas == $toptr03)
                {
                	$status = 2;    
                    $observaciones = 'Pedimento recuperado';
                }
                else
                {
                    $status = 1;
                    $observaciones = 'Error al recuperar partida';
                }
				
			}
            echo 'status'.$status;
            BitacoraPedimento::where('id', $bit->id)->update(['observaciones' => $observaciones,'status' => $status]);		
		}
        //=================================== BITACORA DE COVE =============================================
		$bitacora_cove = BitacoraCove::where('status',0)->get(); 
        foreach ($bitacora_cove as $bcove) 
        { 
        	$bped = BitacoraPedimento::find($bcove->bitacora_pedimento_id);
        	$referen = $bped->aduana.'-'.$bped->patente.'-'.$bped->pedimento;
        	$data_cove = ConsultaCovePrueba::searchCove($bcove->cove, $referen, $this->company);
        	BitacoraCove::where('id',$bcove->id)->update(['status' => $data_cove['status'],'observaciones' => $data_cove['observaciones']]);
        }*/
		           
    }
}
