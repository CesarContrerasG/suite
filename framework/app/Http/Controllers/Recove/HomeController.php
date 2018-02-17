<?php

namespace App\Http\Controllers\Recove;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cove\Seal;
use App\Recove\Pedimento;
use App\Recove\ConsultaCove;
use App\Recove\Contribution;
use App\Recove\Identifier;
use App\Recove\Invoice;
use App\Recove\Item;
use App\Recove\Gravamen;
use App\Recove\IdentifierItem;
use App\Sentry\Module;
use App\Recove\BitacoraPedimento;

class HomeController extends Controller
{
    public function index($id, Request $request)
    {        
        $company = auth()->user()->id;
        //$year = date('Y');
        /*$total = \DB::connection('mysql')->table('bitacora_ED')->where('company_id', $id_company)->where('status', 0)->count();
        $pedimentos = Pedimento::selectRaw('MONTH(ref_fechapago) as mes, COUNT(*) as total')->where('origen', 1)->whereRaw('YEAR(ref_fechapago) = '. $year)->groupby('mes')->get();
        $coves = ConsultaCove::selectRaw('MONTH(cove_fecha) as mes, COUNT(*) as total')->where('cove_firma', 'VUCEM')->whereRaw('YEAR(cove_fecha) = '. $year)->groupby('mes')->get();
        */
        
        $edocument = \DB::connection('mysql')->table('bitacora_ED')->where('status', 0)->where('company_id', $company)->count();
        $records = [];        
        for ($i=1; $i <= 12 ; $i++) {
            $records['pedimentos'][$i] = Pedimento::where('origen', 1)->where(\DB::raw("MONTH(DATE_FORMAT(ref_fechapago, '%Y-%m-%d'))"), $i)->where(\DB::raw("YEAR(DATE_FORMAT(ref_fechapago, '%Y-%m-%d'))"), date("Y"))->count();
            $records['coves'][$i] = ConsultaCove::where('cove_firma', 'VUCEM')->where(\DB::raw("MONTH(DATE_FORMAT(cove_fecha_edocument, '%Y-%m-%d'))"), $i)->where(\DB::raw("YEAR(DATE_FORMAT(cove_fecha_edocument, '%Y-%m-%d'))"), date("Y"))->count();
            //$records['export'][$i] = Cove::where('cove_status', '>', 0)->where('cove_fecha_edocument','!=','0000-00-00')->where(\DB::raw("MONTH(DATE_FORMAT(cove_fecha_edocument, '%Y-%m-%d'))"), $i)->where(\DB::raw("YEAR(DATE_FORMAT(cove_fecha_edocument, '%Y-%m-%d'))"), date("Y"))->where('pk_tipo', 2)->count();                        
        }
        $patentes = BitacoraPedimento::select('patente')->groupby('patente')->get();
        $list_patentes = [];
        $coves = [];
        foreach($patentes as $patente)
        {
            array_push($list_patentes, $patente->patente);
            $total_coves = BitacoraPedimento::join('bitacora_cove', 'bitacora_pedimento_id', '=', 'bitacora_recove.id')->where('patente', $patente->patente)->where('bitacora_cove.observaciones', 'El Cove o Adenda no existe, no está firmado o no cuenta con la autorización para consultarlo')->count();
            array_push($coves, $total_coves);
        }

        //Grafica
        $chartjs = app()->chartjs
             ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'])
            ->datasets([
                [
                    "label" => "Pedimentos",
                    'backgroundColor' => "transparent",
                    'borderColor' => "rgba(219, 74, 91, 0.6)",                           
                    'data' => [
                        $records['pedimentos'][1],
                        $records['pedimentos'][2],
                        $records['pedimentos'][3],
                        $records['pedimentos'][4],
                        $records['pedimentos'][5],
                        $records['pedimentos'][6],
                        $records['pedimentos'][7],
                        $records['pedimentos'][8],
                        $records['pedimentos'][9],
                        $records['pedimentos'][10],
                        $records['pedimentos'][11],
                        $records['pedimentos'][12]
                    ]
                ],
                [   
                        "label" => "Coves",
                        'backgroundColor' => "transparent",
                        'borderColor' => "rgba(73, 175, 235, 0.6)",   
                        'data' => [
                            $records['coves'][1],
                            $records['coves'][2],
                            $records['coves'][3],
                            $records['coves'][4],
                            $records['coves'][5],
                            $records['coves'][6],
                            $records['coves'][7],
                            $records['coves'][8],
                            $records['coves'][9],
                            $records['coves'][10],
                            $records['coves'][11],
                            $records['coves'][12]
                        ]
                    
                ]

            ])
            ->options([
                'scales' => [
                    'xAxes' => [
                        [
                            'display' => true,
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' =>  date("Y")
                            ]
                        ]
                    ],
                    'yAxes' => [
                        [
                            'display' => true,
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'Cantidad'
                            ]
                        ]
                    ]
                ]
            ]);
        
 
        $chart_coves = app()->chartjs
             ->name('lineCoves')
             ->type('line')
             ->size(['width' => 400, 'height' => 200])
             ->labels($list_patentes)
             ->datasets([
                [   
                        "label" => "Coves",
                        'backgroundColor' => "transparent",
                        'borderColor' => "rgba(73, 175, 235, 0.6)",   
                        'data' => $coves
                    
                ]

            ])
            ->options([
                'scales' => [
                    'xAxes' => [
                        [
                            'display' => true,
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' =>  'Patentes'
                            ]
                        ]
                    ],
                    'yAxes' => [
                        [
                            'display' => true,
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'Coves'
                            ]
                        ]
                    ]
                ]
            ]);
        
 
        
        return view('Recove.index', compact('edocument','chartjs', 'chart_coves'));
    }

    public function store(Request $request)
    {
        $seals = Seal::first();    
        $start = microtime(true);
        if(count($seals) > 0)
        {
            //==================== DIRECTORIOS ========================
            $path = storage_path().'/modules/recove/';
            ///////////////////////////////////////////////////////////
            if(!is_null($request->file("file")))
            {
                $file =  $request->file("file")->getClientOriginalName();            
                $request->file("file")->move($path, $file);  
                Pedimento::uploadList($path.$file);
            }
            else
            {
                //============== PARAMETROS DE BUSQUEDA ================================
                $aduanas = explode(',',$request->aduanas);
                $first_date = $request->fecha_ini;
                $finish_date = $request->fecha_fin;  
                //======================== RECORRER ADUANAS =======================================================
                for($i=0; $i<count($aduanas)-1; $i++)
                {
                    $aduana = $aduanas[$i];
                    //========================== RECORRER RANGO DE FECHAS POR DIA ==================================
                    for($f=$first_date; $f<=$finish_date; $f = date("Y-m-d", strtotime($f ."+ 1 days")))
                    {
                        $list = Pedimento::searchList($aduana, $f, $start, $seals->sello_rfc); 
                        if($list == 0)
                        {
                            session()->put('fechaini', $f);
                            session()->put('fechafin', $finish_date);
                            return redirect()->back()->withInput();
                        }
                    }
                }      		
            }
            $bitacora = BitacoraPedimento::where('status','!=',2)->get(); 
            session()->put('total', count($bitacora));
            return view('Recove.bitacora')->with(['type' => 0,'bitacora' => $bitacora]);       
        }
        else
        {
            return redirect()->back();
        } 	
	} 

    public function export()
    {
        $company = auth()->user()->id;
        $pedimentos = BitacoraPedimento::select('aduana','patente','pedimento','fecha')->where(\DB::raw("MONTH(DATE_FORMAT(created_at, '%Y-%m-%d'))"), date("m"))->where(\DB::raw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d'))"), date("Y"))->get();
		\Excel::create('bitacora', function($excel) use($pedimentos){
            $excel->sheet('bitacora', function($sheet) use($pedimentos) {
        	    $sheet->loadView('Recove.bitacora_edocument', array('pedimentos' => $pedimentos));                
            });
        })->download('xls');
    }
   
}
