<?php

namespace App\Http\Controllers\Recove;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Recove\Seal;
use App\Recove\Pedimento;
use App\Recove\Contribution;
use App\Recove\Identifier;
use App\Recove\Invoice;
use App\Recove\Item;
use App\Recove\Gravamen;
use App\Recove\IdentifierItem;
use Illuminate\Support\Facades\Input;
use App\Qore\Company;
use App\Recove\COVE;
use App\Recove\BitacoraPedimento;



class HomeController extends Controller
{
    public function index(Request $request)
    {
        
        //$seal = Seal::first();
        //$year = date('Y');
        $year = 2016;
        $total_ed = \DB::connection('mysql')->table('bitacora_ED')->where('empresa', 'lamtec')->where('status', 0)->count();
        $pedimentos = Pedimento::selectRaw('MONTH(ref_fechapago) as mes, COUNT(*) as total')->where('origen', 1)->whereRaw('YEAR(ref_fechapago) = '. $year)->groupby('mes')->get();
        $coves = COVE::selectRaw('MONTH(cove_fecha) as mes, COUNT(*) as total')->where('cove_firma', 'VUCEM')->whereRaw('YEAR(cove_fecha) = '. $year)->groupby('mes')->get();

        
        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
            ->datasets([
                [
                    "label" => "My First dataset",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [65, 59, 80, 81, 56, 55, 40],
                ],
                [
                    "label" => "My Second dataset",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [12, 33, 44, 44, 55, 23, 40],
                ]
            ])
            ->options([]);

        return view('Recove.index')->with(['total' => $total_ed, 'pedimentos' => $pedimentos, 'coves' => $coves, 'chartjs' => $chartjs]);
    }

    public function store(Request $request)
    {
        ini_set('max_execution_time', 30000);
        $seals = Seal::first();       
        if(!is_null($request->file("file")))
        {
            $file =  $request->file("file")->getClientOriginalName();
            $path = public_path().'/apps/recove/';
            $request->file("file")->move($path,$file);
            $fh = fopen($path.$file, "r"); 
            while ($data = fgetcsv ( $fh)) {
                $dateInput = explode('/',$data[3]);
                $date = $dateInput[2].'-'.$dateInput[1].'-'.$dateInput[0];
                $exis_ped = BitacoraPedimento::where('aduana',$data[0])->where('patente',$data[1])->where('pedimento',$data[2])->count();
                if($exis_ped == 0)                         
                    BitacoraPedimento::insert(['aduana' => $data[0],'patente' => $data[1], 'pedimento' => $data[2],'fecha' => $date, 'status' => 0]);
            }
            fclose($fh);           
        }
        else
        {
            //============== PARAMETROS DE BUSQUEDA ================================
            $aduanas = explode(',',Input::get('aduanas'));

            $first_date = $request->input('fecha_ini');
            $finish_date = $request->input('fecha_fin');        
            
            //======================== RECORRER ADUANAS =======================================================
           	for($i=0; $i<count($aduanas)-1; $i++)
            {
                $aduana = $aduanas[$i];
                //========================== RECORRER RANGO DE FECHAS POR DIA ==================================
                for($f=$first_date; $f<=$finish_date; $f = date("Y-m-d", strtotime($f ."+ 1 days")))
                {           
    	            Pedimento::searchList($seals,$aduana,$f);                
                }  
            }      		
        }
        $bitacora = BitacoraPedimento::where('status','!=',2)->paginate(10); 
        
        return view('Recove.bitacora')->with(['type' => 0,'bitacora' => $bitacora]);        	
	  } 
   
}
