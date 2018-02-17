<?php
namespace App\Http\Controllers\Recove;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Recove\Pedimento;
use App\Recove\Contribution;
use App\Recove\Identifier;
use App\Recove\Invoice;
use App\Recove\Item;
use App\Recove\Gravamen;
use App\Recove\IdentifierItem;
use App\Recove\ConsultaCove;
use App\Qore\Aduana;
use App\Recove\BitacoraPedimento;
use App\Recove\BitacoraCove;
use App\User;
use App\Cove\Seal;


class RecoveController extends Controller
{
    public function index()
    {
    	$aduanas = Aduana::selectRaw('CONCAT(adu_numero,adu_seccion,"|",adu_denomina) as name, CONCAT_WS("", adu_numero, adu_seccion) as id')->pluck('name','id');
    	BitacoraPedimento::where('status',2)->update(['bitacora' => 1]);

    	return view('Recove.process')->with('aduanas', $aduanas);    	
	}	

	public function store()
	{
		$start = microtime(true);
		//================================================== BITACORA DE PEDIMENTO ===================================================================
		$bitacora = BitacoraPedimento::where('status', '!=', 2)->get(); 
        foreach ($bitacora as $bit) 
		{				
			if($bit->status == 0)
			{
				$response = Pedimento::requestCompleteXML($bit);
				if($response != 'false')
					$result = Pedimento::fillData($response,$bit->aduana, $bit->patente, $bit->pedimento, $bit->id);
					
			}
			if($bit->status == 1)
			{
				for($i=1; $i <= $bit->tpartidas; $i++)				
					Pedimento::consultaPartida($i, $bit->id, $bit->aduana, $bit->patente, $bit->pedimento, $bit->operacion);

				$referen = $bit->aduana.'-'.$bit->patente.'-'.$bit->pedimento;
				$toptr03 = Item::where('pk_referencia', $referen)->count();	
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
				BitacoraPedimento::where('id', $bit->id)->update(['observaciones' => $observaciones,'status' => $status]);		
			}
		}
		//=================================== BITACORA DE COVE =============================================
		$bitacora_cove = BitacoraCove::where('status',0)->get(); 
        foreach ($bitacora_cove as $bcove) 
        { 
        	$bped = BitacoraPedimento::find($bcove->bitacora_pedimento_id);
        	$referen = $bped->aduana.'-'.$bped->patente.'-'.$bped->pedimento;
        	$data_cove = ConsultaCove::searchCove($bcove->cove, $referen);
        	BitacoraCove::where('id',$bcove->id)->update(['status' => $data_cove['status'],'observaciones' => $data_cove['observaciones']]);
        }
		$bitacora_new = BitacoraPedimento::leftjoin('bitacora_cove', 'bitacora_recove.id', '=', 'bitacora_pedimento_id')->select('aduana','patente','pedimento','fecha','bitacora_recove.observaciones','bitacora_cove.observaciones as observa_cove')->whereRaw('(bitacora_recove.status < 2 OR bitacora_cove.status = 0) AND bitacora = 0')->get();		
		if(count($bitacora_new) > 0)
			$type = 0;
		else 
			$type = 1;


		return view('Recove.bitacora')->with(['bitacora' =>$bitacora_new,'type' => $type]);
	}
	
	public function export()
	{
		$pedimentos = BitacoraPedimento::leftJoin('bitacora_cove','bitacora_pedimento_id','=','bitacora_recove.id')->select('aduana','patente','pedimento','cove','fecha','bitacora_cove.observaciones as obs_cove','bitacora_recove.observaciones as obs_ped')->where('bitacora',0)->get(); 
		\Excel::create('bitacora', function($excel) use($pedimentos){
            $excel->sheet('bitacora', function($sheet) use($pedimentos) {
        	    $sheet->loadView('Recove.bitacora_xls', array('pedimentos' => $pedimentos));                
            });
        })->download('xls');
	}

	public function download()
	{
		$company = auth()->user()->company_name;
		$path = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/public_html/clientes/ftp/'.$company.'/pdf/2014/'; 
		$results = scandir($path);
		echo "<table>
		        <thead></thead>
		        <tbody>";
		foreach ($results as $result) {
		    if ($result === '.' or $result === '..') continue;

		    if (is_dir($path . '/' . $result)) {
		        $results1 = scandir($path. '/' . $result);
		        foreach ($results1 as $result1) {
			        if ($result1 === '.' or $result1 === '..') continue;
			        echo "
			        	<tr>
			        		<td>".$result1."</td>
			        	</tr>";
		        }
		    }
		}
		echo  "</tbody>
		        </table>";
		/*set_time_limit(0);
		ini_set('memory_limit', '6000M');
		ini_set('max_input_time', '3600');
		ini_set('max_execution_time', '3600');
		$connection = [
                    'driver' => 'mysql',
                    'host' => env('DB_HOST', 'localhost'),
                    'port' => env('DB_PORT', '3306'),
                    'database' =>  'etamcomm_ihb2',
                    'username' => 'etamcomm_secenet',
                    'password' => 'Cesc0ngue_2016',
                    'charset' => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix' => '',
                    'strict' => true,
                    'engine' => null,
        ];
        config(['database.connections.ihb2' => $connection]);
        \DB::setDefaultConnection('ihb2');
        $pdo =  \DB::connection('ihb2')->getPdo();
		$pdo->setAttribute(\PDO::MYSQL_ATTR_MAX_BUFFER_SIZE, 1024*1024*50); 
		$pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
  		$imagenes =\DB::table('opauimg')->where('imgImageData','!=','')->orderBy('iImageID', 'desc')->get();
		foreach ($imagenes as $img) 
		{
			$optr01 = \DB::table('optr01')->where('pk_referencia',$img->pk_referencia)->first();
			if($optr01)
			{
				$periodo =  date('Y',strtotime($optr01->ref_fechapago));
				$path = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/public_html/clientes/ftp/ihb/pdf/'.$periodo.'/'.$img->pk_referencia; 
							
				if (!file_exists($path))
	     			@mkdir($path, 0777,true);
				
				if(is_null($img->imgNameFile))
				{
					$val = explode('-->',$img->strImageName);
					if($val[0] == 'Acuse COVE ')

						$filename = $img->pk_referencia.'_Acuse COVE_'.$img->cove_factura.'_'.$img->iImageID.'.pdf';
					else
						$filename = $img->pk_referencia.'_Acuse_'.$img->iImageID.'.pdf';

					$name = $path.'/'.$filename;
					\DB::table('opauimg')->where('iImageID',$img->iImageID)->update(['imgNameFile' => $filename]);
					
				}
				else
				{
					$name = $path.'/'.$img->imgNameFile;				

				}
			
	    		file_put_contents($name, $img->imgImageData);   		
	    	}
		}*/
	}

	/*protected  function validateTime($start)
	{
		$time =  microtime(true) - $start;
		if($time > '10000000')
		{
			$bitacora_new = BitacoraPedimento::where('status',0)->where('bitacora',0)->paginate(10);		
			if(count($bitacora_new) > 0)
				$type = 0;
			else 
				$type = 1;
		
			return view('Recove.bitacora')->with(['bitacora' =>$bitacora_new,'type' => $type]);
		}

	}*/
   
}
