<?php

namespace App\Http\Controllers\Anexo31;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Anexo31\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inicial = Inventory::where('tipo','01')->count();
        $rectif = Inventory::where('tipo','09')->select('folio_original')->distinct()->get();
        
    	return view('Anexo31.inventory.index')->with(['inicial' => $inicial, 'rectif' => $rectif]);	
    }

    public function store(Request $request)
    {
        $inicial = Inventory::where('tipo', '01')->count();
        if($inicial > 0 && is_null($request->get('tipo')))
            return 'inventario ya cargado';
        else
           Inventory::insertData($request->file('file'), $request->get('folio_original'), $request->get('tipo'));
        

        return redirect()->back();
    }
}