<?php 
namespace App\Anexo31;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;
use App\Qore\DestinationA31;

class Discharge extends Model{

    protected $connection = 'default';
    protected $table = 'descargo';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
        $this->guarded = ['id'];
    }
     
    public function details()
    {
        return $this->hasMany('App\Anexo31\Detail','descargo_id');
    }

    public function pedimentos()
    {
        return $this->hasMany('App\Anexo31\Pedimento','descargo_id');
    }

    public function folios()
    {
        return $this->hasMany('App\Anexo31\Folio','descargo_id');
    }

    public function destination()
    {
        return $this->belongsTo('App\Qore\Destination','destino');
    }

    public function period()
    {
        return $this->belongsTo('App\Anexo31\Period', 'period_id');   
    }

    public static function insertData($file, $folio)
    {     
        if($file->getClientOriginalExtension() == 'txt')
            $file->storeAs('/', $file->getClientOriginalName(),'documents'); 
            
        $dir = \Storage::disk('documents')->getDriver()->getAdapter()->getPathPrefix();
        $archivo = $dir.'/'.$file->getClientOriginalName();
        
        foreach(file($archivo) as $idL => $line) 
        {
            $field = explode("|",$line); 
            if(trim($field[0]) == '02')
            {
                $period = Period::where('clave', trim($field[3]))->first();   
                $day = 'AND DAY(FechaPagoReal) <= 31';
                $months = explode('-', $period->month);
                if($period->type < 4)
                {
                    $month = ' = '.$months[0];                        
                    if($period->type == 2) 
                        $day = 'AND DAY(FechaPagoReal) <= 15 ';
                    if($period->type == 3) 
                        $day = 'AND DAY(FechaPagoReal) > 15 ';
                }
                else
                {
                    $month = 'IN('.$months[0].','. $months[1].')';
                }                
                
                $wheremonth = 'MONTH(FechaPagoReal) '.$month. ' '.$day;
                $exist = \DB::table('ds501')->whereRaw($wheremonth.' AND YEAR(FechaPagoReal) = '.trim($field[2]))->count();
                if($exist > 0)
                {                        
                    $destin = DestinationA31::where('des_clave', trim($field[1]))->first();
                    $desc = Discharge::where('destino', $destin->id)->where('anio', trim($field[2]))->where('periodo_id', $period->id)->first();   
                    $excepts = explode(',', $period->except);
                    foreach($excepts as $exc)
                    {
                        $exist = Discharge::where('destino', $destin->id)->where('anio', trim($field[2]))->where('periodo_id', $exc)->count();   
                        if($exist > 0)
                            return false;
                    }          
                    if(is_null($desc) || isset($field[4]))
                    {
                        $folio_ant = '';
                        if(isset($field[4]))
                        {
                            Discharge::where('folio_original', trim($field[4]))->update(['status' => 0]);
                            $folio_ant = trim($field[4]);
                        }
                        $id = Discharge::insertGetId(['destino' => $destin->id, 'anio' => trim($field[2]), 'periodo_id' => $period->id, 'folio' => $folio_ant, 'folio_original' => $folio]);
                    }
                    else
                    {
                        if(isset($field[4]))
                            $id = $desc->id;
                        else
                            $id = '';
                        Balance::where('tipo', 2)->where('descargo', $id)->delete();
                        Balance::where('tipo', 1)->update(['descargo' => 0, 'saldo' => 0, 'iva' => 0]);
                        
                    }
                }  
                else
                {
                    dd('error');
                }
            }
            if($id != '')
            {
                if(trim($field[0]) == '03')
                    Detail::insert(['fraccion' => trim($field[1]),'valor' => trim($field[2]), 'afijo' => trim($field[3]), 'descargo_id' => $id]);
                if(trim($field[0]) == '04')
                    Pedimento::insert(['aduana' => trim($field[3]), 'patente' => trim($field[1]), 'pedimento' => trim($field[2]), 'descargo_id' => $id]);
                if(trim($field[0]) == '05')
                    Folio::insert(['folio' => trim($field[1]), 'descargo_id' => $id]);
            }            
        }  
        return true;
    }   

    public static function deleteData($id)
    {   
        $descargo = Discharge::find($id);
        $descargo->delete();
        $descargo->details()->delete();
        $descargo->pedimentos()->delete();
        $descargo->folios()->delete();
    }
}