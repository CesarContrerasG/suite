<?php

namespace App\Http\Controllers\Anexo31;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Anexo31\DataStage;


class DataStageController extends Controller
{
    public function store(Request $request)
    {
        foreach($request->file('file') as $file) 
        {
            if($file->getClientOriginalExtension() == 'asc')
                $file->storeAs('/', $file->getClientOriginalName(),'documents'); 
        }

        $dir = \Storage::disk('documents')->getDriver()->getAdapter()->getPathPrefix();
        if($var = opendir($dir)) 
        {
            while (false !== ($archivo = readdir($var))) 
            {
                if ($archivo != "." && $archivo != "..")
                {
                    $ext = pathinfo($archivo, PATHINFO_EXTENSION);
                    if($ext == 'asc')
                        DataStage::insertData($archivo, $dir, $request->get('reemplazar'));                
                }
            }
        }
        DataStage::calculaVencimiento();

        return redirect()->back();
    }
    
}