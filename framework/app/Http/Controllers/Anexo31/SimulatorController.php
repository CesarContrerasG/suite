<?php

namespace App\Http\Controllers\Anexo31;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Anexo31\Discharge;
use App\Anexo31\Inventory;
use App\Anexo31\Balance;
use App\Anexo31\Detail;
use App\Anexo31\Period;

class SimulatorController extends Controller
{
    public function index()
    {    	
        $periodos = Discharge::join('periodos', 'periodo_id', '=', 'periodos.id')->where('status', 1)->selectRaw('CONCAT(descripcion,"/",anio) as periodo')->pluck('periodo', 'periodo');
        $anios = Discharge::select('anio')->distinct('anio')->pluck('anio', 'anio');

    	return view('Anexo31.simulator.index')->with(['periodos' => $periodos, 'anios' => $anios]);	
    }

    public function store(Request $request)
    {

        if($request->get('month') == 1)
            $months = [1, 13, 14];
        if($request->get('month') == 2)
            $months = [1, 2, 13, 14, 15, 16, 37];
        if($request->get('month') == 3)
            $months = [1, 2, 3, 13, 14, 15, 16, 17, 18, 37];
        if($request->get('month') == 4)
            $months = [1, 2, 3, 4, 13, 14, 15, 16, 17, 18, 19, 20, 37, 38];
        if($request->get('month') == 5)
            $months = [1, 2, 3, 4, 5, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 37, 38];
        if($request->get('month') == 6)
            $months = [1, 2, 3, 4, 5, 6, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 37, 38, 39];
        if($request->get('month') == 7)
            $months = [1, 2, 3, 4, 5, 6, 7, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 37, 38, 39];
        if($request->get('month') == 8)
            $months = [1, 2, 3, 4, 5, 6, 7, 8, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 37, 38, 39, 40];
        if($request->get('month') == 9)
            $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 37, 38, 39, 40];
        if($request->get('month') == 10)
            $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 37, 38, 39, 40, 41];
        if($request->get('month') == 11)
            $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 37, 38, 39, 40, 41];
        if($request->get('month') == 12)
            $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42];

        $discharges = Discharge::where('status', 1)->where('anio', $request->get('year'))->whereIn('periodo_id',$months)->get();
        foreach($discharges as $discharge)
        {
            Balance::insertSaldos($discharge, $request->get('month'));
            Balance::process($discharge);
        }

        $result = Balance::selectRaw('fraccion, SUM(saldo_ini) as cargo, SUM(iva_inv) as iva_inv, SUM(descargo) as abono, SUM(iva_des) as iva_des, SUM(saldo) as saldo, SUM(iva) as iva')->groupby('fraccion')->get();

        return view('Anexo31.simulator.result')->with('result', $result);
        
    }

}