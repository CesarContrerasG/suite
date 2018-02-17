<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cove\InventoryRequest;
use App\Cove\Inventory;
use App\Cove\Invoice;
use App\Cove\Cove;

class InventoryController extends Controller
{
    public function store(InventoryRequest $request)
    {
        Inventory::insertOrUpdate($request);

        return redirect()->back();
    }

    public function show(Inventory $inventory)
    {
        return response()->json(['inventory' => $inventory]);
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return response()->json(['redirect' => 'edit']);
    }

    public function change(Request $request)
    {
        $inventory = Inventory::find($request->item);
        $inventory->inv_sec = $request->sec;
        $inventory->save();

        return response()->json(['id' =>  $request]); 
    }

    public function upload(Request $request)
    {
        if($request->hasFile('file'))
        {   
            $extension = $request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')->getRealPath();            
            if($extension == 'csv')
            {
                if (($file = fopen($path,'r')) !== FALSE)
                {
                    fgetcsv($file);  
                    Inventory::import($file, $request);
                    fclose($file);
                }
            }
            elseif($extension == 'xml')
            {   
                $xml = simplexml_load_file($path);                
                Invoice::import($xml, $request);
            }
        } 
        
        return redirect()->back();
    }
}