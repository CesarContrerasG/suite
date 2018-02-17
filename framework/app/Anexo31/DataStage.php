<?php 
namespace App\Anexo31;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;
use App\Qore\Company;

class DataStage extends Model{

    protected $connection = 'default';
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();           
        $this->connection = $bd;
        $this->table = session()->get('table');
        
    }

    public static function insertData($archivo, $dir, $reemplazar)
    {
        set_time_limit(0);
    	$name = pathinfo($archivo, PATHINFO_FILENAME);
        $folio = explode('_', $name);  
        if(count($folio) == 2 && !in_array($folio[1],['Inci','Resumen','Sel']))
        {        
            session()->put('table', 'ds'.$folio[1]);         
            $record =  DataStage::where('folio_ds', $folio[0])->first();
            if(is_null($record) || $reemplazar == 1)
            {
                if($reemplazar == 1)
                     DataStage::where('folio_ds', $folio[0])->delete();

                \Excel::load($dir.'/'.$archivo, function($reader) use($folio) {
                    foreach ($reader->get() as $data) 
                    {                       
                        DataStage::insert($data->toArray());
                        DataStage::whereNull('folio_ds')->update(['folio_ds' => $folio[0]]);                        
                    }
                });
            }
            
            session()->forget('table');
	    }
	    unlink($dir.'/'.$archivo);
    }
    
    public static function calculaVencimiento()
    {
        $id = \Auth::user()->departament->company->id;
        $company = Company::find($id);
        $fechas = $company->certifications()->wherePivot('company_id', $id)->get(); 
        $fecha_cer = '';
        $cerOEA = 0;
        foreach($fechas as $fecha)
        {
            if($fecha->certification_id == 1)
                $fecha_cer = $fecha->date_cer;
            if($fecha->certification_id == 2)
                $cerOEA = 1;
        }
        $fecha_6m = '2010-12-25';
        $fecha_fra = '2011-03-24';
        $fecha_retro = '2010-01-01';
        $meses = 18;
        $inventario = \DB::table('ds551')->whereNull('FechaVencimiento')->get();        
        foreach($inventario as $inv)
        {
            //============================ CALCULO DE VENCIMIENTO - CLAVE =============================================
            if($inv->ClaveDocumento == 'V1')
            {
                if(strtotime($inv->FechaPagoReal) > $fecha_6m)
                    $meses = 6;
            }
            elseif($inv->ClaveDocumento == 'AF')
            {
                $meses = 100;
            }
            else
            {
                if(strtotime($inv->FechaPagoReal) > $fecha_fra)
                {
                    $fraccion  = \DB::table('temxf801')->where('fraccion', $inv->Fraccion)->first();
                    if(!is_null($fraccion))
                    {
                        if($fraccion->anexo == 'I')
                            $meses = 9;
                        elseif($fraccion->anexo == 'I BIS')
                                $meses = 6;
                            else
                                $meses = 12;
                    }
                }
            }
            $fecha_vence = date("Y-m-d", strtotime("+".$meses." month", strtotime($inv->FechaPagoReal)));            
            //============================ CALCULO DE VENCIMIENTO - CERTIFICADO =============================================
            if($fecha_vence >= $fecha_cer && $cerOEA == 1) 
            {
                if($inv->FechaPagoReal >= $fecha_retro)
                    $meses = 36;
                else 
                    $meses = 18;
            }
            $fecha_vence = date("Y-m-d", strtotime("+".$meses." month", strtotime($inv->FechaPagoReal)));        
            $where = [['SeccionAduanera', '=', $inv->SeccionAduanera], ['Patente', '=', $inv->Patente], ['Pedimento', '=', $inv->Pedimento], ['Fraccion', '=', $inv->Fraccion], ['SecuenciaFraccion', '=', $inv->SecuenciaFraccion]];
            \DB::table('ds551')->where($where)->update(['FechaVencimiento' => $fecha_vence]);
        }
    }
   
}