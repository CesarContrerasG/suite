<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cove\Cove;
use App\Cove\Digital;

class HomeController extends Controller
{
    public function index()
    {

        $coves_type = Cove::selectRaw('pk_tipo, YEAR(cove_fecha_edocument) as anio, MONTH(cove_fecha_edocument) as mes, COUNT(cove_edocument) AS coves')
        ->where('cove_status', '>', 0)->where('cove_fecha_edocument','!=','0000-00-00')->groupby('pk_tipo')->groupby('anio')->groupby('mes')->get();
        $coves_type = Cove::selectRaw('cove_patente, YEAR(cove_fecha_edocument) as anio, MONTH(cove_fecha_edocument) as mes, COUNT(cove_edocument) AS coves')
        ->where('cove_status', '>', 0)->where('cove_fecha_edocument','!=','0000-00-00')->groupby('cove_patente')->groupby('anio')->groupby('mes')->get();

        $records = [];        
        for ($i=1; $i <= 12 ; $i++) {
            $records['import'][$i] = Cove::where('cove_status', '>', 0)->where('cove_fecha_edocument','!=','0000-00-00')->where(\DB::raw("MONTH(DATE_FORMAT(cove_fecha_edocument, '%Y-%m-%d'))"), $i)->where(\DB::raw("YEAR(DATE_FORMAT(cove_fecha_edocument, '%Y-%m-%d'))"), date("Y"))->where('pk_tipo', 1)->count();
            $records['export'][$i] = Cove::where('cove_status', '>', 0)->where('cove_fecha_edocument','!=','0000-00-00')->where(\DB::raw("MONTH(DATE_FORMAT(cove_fecha_edocument, '%Y-%m-%d'))"), $i)->where(\DB::raw("YEAR(DATE_FORMAT(cove_fecha_edocument, '%Y-%m-%d'))"), date("Y"))->where('pk_tipo', 2)->count();                        
        }
        $labels = [];
        $data = [];
        $results = Cove::selectRaw('cove_patente, COUNT(cove_edocument) as coves')
            ->where('cove_status', '>', 0)->where('cove_fecha_edocument','!=','0000-00-00')->where(\DB::raw("MONTH(DATE_FORMAT(cove_fecha_edocument, '%Y-%m-%d'))"), date('m'))
            ->where(\DB::raw("YEAR(DATE_FORMAT(cove_fecha_edocument, '%Y-%m-%d'))"), date("Y"))->groupby('cove_patente')->get();
        $adendas = [];
        foreach($results as $res => $result) 
        {
            array_push($labels, $result->cove_patente);
            array_push($data, $result->coves);
            $no_adenda = Cove::where('cove_patente', $result->cove_patente)->sum('cove_adenda');
            array_push($adendas, $no_adenda);
        }
        $total_coves = Cove::where('cove_edocument', '')->count();
        $total_ed = Digital::where('imgEdocument', '')->where('imgtipodoc', '!=', '000')->where('cove_factura', NULL)->count();
        $total_relation = Cove::where('cove_status', '!=', 3)->where('cove_edocument', '!=', '')->count();

        $chart_type = app()->chartjs
            ->name('GraphCoves')
            ->type('line')
            ->labels(['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'])
            ->datasets([
                [
                    "label" => "Importación",
                    'backgroundColor' => "transparent",
                    'borderColor' => "rgba(134, 60, 207,1)",                
                    'data' => [
                        $records['import'][1],
                        $records['import'][2],
                        $records['import'][3],
                        $records['import'][4],
                        $records['import'][5],
                        $records['import'][6],
                        $records['import'][7],
                        $records['import'][8],
                        $records['import'][9],
                        $records['import'][10],
                        $records['import'][11],
                        $records['import'][12]
                    ]
                ],
                [   
                    "label" => "Exportación",
                    'backgroundColor' => "transparent",
                    'borderColor' => "rgba(207, 60, 133, 1)",   
                    'data' => [
                        $records['export'][1],
                        $records['export'][2],
                        $records['export'][3],
                        $records['export'][4],
                        $records['export'][5],
                        $records['export'][6],
                        $records['export'][7],
                        $records['export'][8],
                        $records['export'][9],
                        $records['export'][10],
                        $records['export'][11],
                        $records['export'][12]
                    ]
                ]

            ])
            ->options([
                'scales' => [
                    'yAxes' => [
                        [
                            'display' => true,
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'COVE'
                            ]
                        ]
                    ]
                ]
            ]);
        
        
        $chart_patente = app()->chartjs
            ->name('pieChartCoves')
            ->type('bar')
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Coves",
                    'backgroundColor' => 'rgba(158, 30, 80, 1)',               
                    'data' => $data
                ],
                [
                    "label" => "Adendas",
                    'backgroundColor' => 'rgba(244, 208, 63, 0.8)',               
                    'data' => $adendas
                ]

            ])
            ->options([
                'scales' => [
                    'xAxes' => [
                        [
                            'display' => true,
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'Patentes'
                            ]
                        ]
                    ],
                    'yAxes' => [
                        [
                            'display' => true,
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'COVE'
                            ]
                        ]
                    ]
                ]
            ]);
        
        return view('Cove.index', compact('chart_type', 'chart_patente', 'total_coves', 'total_ed', 'total_relation')); 
    }

    public function catalogs()
    {
        return view('Cove.catalogs');
    }

    public function operations()
    {
        return view('Cove.operations');
    }

    public function reports(Request $request)
    {
        if(!isset($request->date_start))
            $coves = Cove::with('invoices')->where('cove_edocument', '!=', '')->paginate(10);
        else
            $coves = Cove::with('invoices')->whereBetween('cove_fecha_edocument', [$request->date_start, $request->date_end])->paginate(10);

        return view('Cove.reports')->with('coves', $coves);
    }

   /* public function dashboard()
    {
        
    }*/
}