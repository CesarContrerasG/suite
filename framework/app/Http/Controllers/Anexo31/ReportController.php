<?php

namespace App\Http\Controllers\Anexo31;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Anexo31\Balance;

class ReportController extends Controller
{
    public function index()
    {
        $inventario = Balance::selectRaw('SUM(saldo_ini) as inicial, SUM(descargo) as descargo, SUM(saldo) as saldo')->where('tipo', 1)->first();
        $posterior = Balance::selectRaw('SUM(saldo_ini) as cargos, SUM(iva_inv) as iva_cargos, SUM(iva_des) as iva_abonos, SUM(descargo) as abonos, SUM(saldo) as saldo, SUM(iva) as iva')->where('tipo', 2)->first();
        $fracciones = Balance::selectRaw('fraccion, SUM(saldo_ini) as total, SUM(IF(tipo = 1, saldo_ini, 0)) as inicial, SUM(IF(tipo = 2, saldo_ini, 0)) as cargos, SUM(iva_inv) as iva_cargos, SUM(descargo) as abonos, SUM(iva_des) as iva_abonos, SUM(saldo) as saldo, SUM(iva) as iva')->groupby('fraccion')->get();

    	return view('Anexo31.reports.index')->with(['inventario' => $inventario, 'posterior' => $posterior, 'fracciones' => $fracciones]);	
    }

    public function graph()
    {
        $saldos =  Balance::selectRaw('month(fecha) AS mes, sum(iva_inv) as iva, sum(iva_des) as iva2, sum(iva) as iva3')->groupby(\DB::raw('month(fecha)'))->get();

        return response()->json($saldos);
    }
}