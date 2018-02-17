<?php

namespace App\Http\Controllers\Anexo31;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Anexo31\DataStage;
use App\Anexo31\Inventory;

class UploadController extends Controller
{
    public function index()
    {
        session()->put('table', 'ds501');   
        $datastage = DataStage::selectRaw('folio_ds, MONTH(FechaPagoReal) as mes, YEAR(FechaPagoReal) as anio')->distinct()->get();
        session()->forget('table');
        $invetory = Inventory::select('folio_original','tipo')->distinct()->get();

    	return view('Anexo31.upload.index')->with(['datastage' => $datastage, 'inventory' => $invetory]);	
    }
}