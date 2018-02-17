<?php



namespace App\Http\Controllers\Recove;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Recove\ConsultaED;
use App\Recove\Pedimento;
use App\ConnectionDB;
use App\Qore\Company;



class DocumentController extends Controller

{

    public function show($referen)

    {    	

    	$documents = ConsultaED::where('pk_referencia',$referen)->where('imgNumeroOperacion',NULL)->where('imgEdocument','!=','')->get();
    	

        return view('Recove.document')->with(['documents' => $documents,'referen' => $referen]);

    }

    public function download($referen, $ed)
    {

    	$id_company =  session()->get('company');
        $company = Company::find($id_company);
    	$pedimento = Pedimento::where('pk_referencia',$referen)->first();
    	$periodo = date('Y',strtotime($pedimento->ref_fechapago));
        $pos = strpos($ed, '.pdf');
        if($pos == false)           
            $file = $referen.'_Acuse_'.$ed.'.pdf';
        else
            $file = $ed;
        $site_ftp = \DB::connection('mysql')->table('config_dir')->where('company',$id_company)->count(); 
        if($site_ftp > 0)
        {
            $path_ftp = 'pdf/'.$periodo.'/'.$referen.'/';
            $connect = ConnectionDB::getFTPPath($company->name,$path_ftp);
            if($connect != false)
            {                   
                if(ftp_get($connect, $file, $path_ftp.$file, FTP_BINARY)) 
                {
                    header('Content-Disposition: attachment; filename="'. $file .'"');
                    readfile($file);          
                }
                ftp_close($connect);
            }               
        }
        else
        {
            $path_ftp = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/public_html/clientes/ftp/'.$company->name.'/pdf/'.$periodo.'/'.$referen;
            if(file_exists($path_ftp)) 
                return response()->download($path_ftp.'/'.$file);

        } 
    }

    public function export()
    {
        $id_company = session()->get('company');
        $documents = \DB::connection('mysql')->table('bitacora_ED')->where('empresa',$id_company)->get(); 
        \Excel::create('bitacora', function($excel) use($documents){
            $excel->sheet('bitacora', function($sheet) use($documents) {
                $sheet->loadView('Recove.bitacoraED_xls', array('documents' => $documents));                
            });
        })->download('xls');
    }

}