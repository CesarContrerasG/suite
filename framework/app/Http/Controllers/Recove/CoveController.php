<?php
namespace App\Http\Controllers\Recove;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Recove\COVE;
use App\ConnectionDB;
use Appp\Qore\Company;

class CoveController extends Controller
{
    public function show($referen)
    {
        $coves = COVE::where('pk_referencia', $referen)->get();
        return view('Recove.cove')->with(['coves' => $coves,'referen' => $referen]);
    }
    public function download($ed, $referen, $id)
    {
        $id_company = session()->get('company');  
        $company = Company::find($id_company);
        $cove = COVE::where('cove_edocument',$ed)->first();      
        $path = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
        
        if($cove != '')
        { 
            $anio = date('Y', strtotime($cove->cove_fecha));
            $site_ftp = \DB::connection('mysql')->table('config_dir')->where('company',$id_company)->count(); 
           
          	if($id == 1)
           	{
                if($site_ftp > 0)
                {
                    $path_ftp = 'xml/';
                    $name_file = 'cove_xml_'.$ed.'.xml';
                    $connect = ConnectionDB::getFTPPath($company->name,$path_ftp);
        
                    if($connect != false)
                    {                   
                        if(ftp_get($connect, $name_file, $path_ftp.$name_file, FTP_BINARY)) 
                        {
                            header('Content-Disposition: attachment; filename="'. $name_file .'"');
                            readfile($name_file);          
                        }
                         ftp_close($connect);
                    }               
                }
                else
                {
           		    $path_ftp = $path.'/public_html/clientes/ftp/'.$company->name.'/'.'xml/cove_xml_'.$ed.'.xml';
                    if(file_exists($path_ftp)) 
                        return response()->download($path_ftp);
                }
           	}
           	else
           	{   
                if($site_ftp > 0)
                {
                    $path_ftp = 'pdf/'.$anio.'/'.$referen.'/';
                    $name_file = $referen.'_Acuse COVE_'.$ed.'.pdf';
                    $connect = ConnectionDB::getFTPPath($company->name,$path_ftp);
                    if($connect != false)
                    {                   
                        if(ftp_get($connect, $name_file, $path_ftp.$name_file, FTP_BINARY))
                        {
                            header('Content-Disposition: attachment; filename="'. $name_file .'"');
                            readfile($name_file);       
                        }
                        ftp_close($connect);
                    }   
                }
                else
                {
           		    $path_ftp = $path.'/public_html/clientes/ftp/'.$company->name.'/'.'pdf/'.$anio.'/'.$referen.'/'.$referen.'_Acuse COVE_'.$ed.'.pdf';
                    if(file_exists($path_ftp))
                        return response()->download($path_ftp); 
                }
           	}  
            
        }
    }
}