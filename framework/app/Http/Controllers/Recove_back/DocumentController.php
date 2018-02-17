<?php



namespace App\Http\Controllers\Recove;



use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Recove\ConsultaED;

use App\Recove\Pedimento;

use App\User;



class DocumentController extends Controller

{

    public function show($referen)

    {    	

    	$documents = ConsultaED::where('pk_referencia',$referen)->where('imgNumeroOperacion',NULL)->where('imgEdocument','!=','')->get();

    	

        return view('Recove.document')->with(['documents' => $documents,'referen' => $referen]);

    }

    public function download($referen, $ed)
    {

    	$empresa =  User::changeConnection();    
    	$pedimento = Pedimento::where('pk_referencia',$referen)->first();
    	$periodo = date('Y',strtotime($pedimento->ref_fechapago));
        $pos = strpos($ed, '.pdf');
        if($pos == false)           
            $file = $referen.'_Acuse_'.$ed.'.pdf';
        else
            $file = $ed;
        $site_ftp = \DB::connection('mysql')->table('config_dir')->where('company',$empresa)->count(); 
        if($site_ftp > 0)
        {
            $path_ftp = 'pdf/'.$periodo.'/'.$referen.'/';
            $connect = User::getFTPPath($empresa,$path_ftp);
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
            $path_ftp = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/public_html/clientes/ftp/'.$empresa.'/pdf/'.$periodo.'/'.$referen;
            if(file_exists($path_ftp)) 
                return response()->download($path_ftp.'/'.$file);

        } 
    }

    public function export()
    {
        $emp = User::changeConnection(); 
        $documents = \DB::connection('mysql')->table('bitacora_ED')->where('empresa',$emp)->get(); 
        \Excel::create('bitacora', function($excel) use($documents){
            $excel->sheet('bitacora', function($sheet) use($documents) {
                $sheet->loadView('Recove.bitacoraED_xls', array('documents' => $documents));                
            });
        })->download('xls');
    }

}