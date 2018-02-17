<?php 
namespace App\Anexo31;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Balance extends Model{

    protected $connection = 'default';
    protected $table = 'saldos';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }   

    public static function insertSaldos($discharge, $mes)
    {
        //====================================== CARGA DE INVENTARIO INICIAL A SALDOS ==================================
        $inventory = Inventory::orderBy('fraccion')->orderBy('fecha','ASC')->get();
        foreach($inventory as $inv)
        {
            $exist = Balance::where('fraccion', $inv->fraccion)->where('fecha', $inv->fecha)->count();
            if($exist == 0)
                Balance::insert(['fecha' => $inv->fecha, 'aduana' => $inv->aduana, 'patente' => $inv->patente, 'pedimento' => $inv->pedimento, 'fraccion' => $inv->fraccion, 'saldo_ini' => $inv->saldo, 'saldo' => $inv->saldo, 'tipo' => 1]);
        }   
        //====================================== OBTENER FRACCIONES A DESCARGAR DE DS ==================================
        $fracciones = Detail::select('fraccion')->where('descargo_id', $discharge->id)->groupBy('fraccion')->get();
        foreach($fracciones as $frac)
        {                           
            Balance::uploadPos($frac, $discharge, $mes);      
        }  


       

    } 

    public static function convertDate($discharge)
    {
        $whereday = 'AND DAY(FechaPagoReal) <= 31';
        $fortnight_1 = [13, 15, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35];
        $fortnight_2 = [14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36];

        $january = [1, 13, 14, 37];
        $february = [2, 15, 16, 37];
        $march = [3, 17, 18, 38];
        $april = [4, 19, 20, 38];
        $may = [5, 21, 22, 39];
        $june = [6, 23, 24, 39];
        $july = [7, 25, 26, 40];
        $august = [8, 27, 28, 40];
        $september = [9, 29, 30, 41];
        $october = [10, 31, 32, 41];
        $november= [11, 33, 34, 42];
        $december = [12, 35, 36, 42];

        if(in_array($discharge->periodo_id, $fortnight_1))
            $whereday = 'AND DAY(FechaPagoReal) <= 15 ';
        if(in_array($discharge->periodo_id, $fortnight_1))
            $whereday = 'AND DAY(FechaPagoReal) > 15 ';

        $months = [];               
        if(in_array($discharge->periodo_id, $january))
            array_push($months, 1);
        if(in_array($discharge->periodo_id, $february))
            array_push($months, 2);
        if(in_array($discharge->periodo_id, $march))
            array_push($months, 3);
        if(in_array($discharge->periodo_id, $april))
            array_push($months, 4);
        if(in_array($discharge->periodo_id, $may))
            array_push($months, 5);
        if(in_array($discharge->periodo_id, $june))
            array_push($months, 6);
        if(in_array($discharge->periodo_id, $july))
            array_push($months, 7);
        if(in_array($discharge->periodo_id, $august))
            array_push($months, 8);
        if(in_array($discharge->periodo_id, $september))
            array_push($months, 9);
        if(in_array($discharge->periodo_id, $october))
            array_push($months, 10);
        if(in_array($discharge->periodo_id, $november))
            array_push($months, 11);
        if(in_array($discharge->periodo_id, $december))
            array_push($months, 12);
        
        $wheremonth = 'MONTH(FechaPagoReal) IN('.implode(",", $months). ')';

        return ['day' => $whereday, 'month' => $wheremonth];
    }

    public static function uploadPos($frac, $discharge, $mes)
    {
        $where = Balance::convertDate($discharge);
        $poster = \DB::table('ds551')->where('fraccion',$frac->fraccion)->where('TipoOperacion', 1)->whereRaw($where['month'].' '.$where['day'].' AND YEAR(FechaPagoReal) <= '.$discharge->anio)
                        ->whereRaw('MONTH(FechaVencimiento) >= '.$mes.' AND  YEAR(FechaVencimiento) >= '.$discharge->anio)->orderBy('FechaPagoReal')->get();
        foreach($poster as $pos)
        {
            $exist_ds = Balance::where('fraccion', $pos->Fraccion)->where('fecha', date('Y-m-d', strtotime($pos->FechaPagoReal)))->where('aduana', $pos->SeccionAduanera)->where('patente', $pos->Patente)->where('pedimento', $pos->Pedimento)->where('secuencial', $pos->SecuenciaFraccion)->count();
            if($exist_ds == 0)
                Balance::insert(['fecha' => $pos->FechaPagoReal, 'fraccion' => $pos->Fraccion, 'aduana' => $pos->SeccionAduanera, 'patente' => $pos->Patente, 'pedimento' => $pos->Pedimento, 'clave' => $pos->ClaveDocumento, 'secuencial' => $pos->SecuenciaFraccion,'saldo_ini' => $pos->ValorComercial, 'tipo' => 2]);
        }
    }

    public static function process($discharge)
    {
        $fraccion = '';
        $fracciones = Detail::selectRaw('fraccion, SUM(valor) as valor')->where('descargo_id', $discharge->id)->groupBy('fraccion')->get();
        foreach($fracciones as $frac)
        {   
            $iva = 0;
            $iva_des = 0;
            $iva_inv = 0;
            $saldo_ped = 0;
            $saldo = 0;      
            $descargo = 0;   
            $descarga = 0;            
            if($fraccion != $frac->fraccion)
                $total = $frac->valor;
            $total = round($total, 2);
            $fraccion = $frac->fraccion; 
            $pendiente = Balance::where('fraccion', $fraccion)->where('saldo', '>', 0)->first();
            if(!is_null($pendiente))
            {
                $saldo_ped = $pendiente->saldo;
                $descarga = $pendiente->descargo;
            }               
            if($saldo_ped >= $total)
            {
                $saldo =  $saldo_ped - $total;                                      
                $descargo = $descarga + $total;
                $total = 0; 
            }
            else{
                $total = $total - $saldo_ped;   
                $descargo = $descarga + $saldo_ped;       
            }
            if(!is_null($pendiente))
                Balance::where('id', $pendiente->id)->update(['saldo' => $saldo, 'descargo' => $descargo]);               
            
            $saldos = Balance::where('fraccion', $fraccion)->where('descargo', 0)->get();                        
            foreach($saldos as $sal)
            {      
                $saldo = $sal->saldo_ini;
                if($total == 0)
                {
                    $descargo = 0;
                    $total = 0;
                    
                }
                else
                {
                    if($total < $sal->saldo_ini)
                    {
                        $descargo = $total;
                        $saldo = $sal->saldo_ini - $total;
                        $total = 0;
                    }
                    else
                    {
                        $descargo = $sal->saldo_ini;
                        $saldo = 0;
                        $total = $total - $sal->saldo_ini;                
                    }    
                }   
                if($sal->tipo == 2 && $saldo > 0)
                {
                    $contribucion = \DB::table('ds557')->where('SeccionAduanera', $sal->aduana)->where('Patente', $sal->patente)->where('Pedimento', $sal->pedimento)->where('Fraccion', $sal->fraccion)
                               ->where('SecuenciaFraccion', $sal->secuencial)->where('ClaveContribucion', 3)->where('FormaPago', 21)->first();
                    if(!is_null($contribucion))
                    {
                        $valor = $saldo * $contribucion->ImportePago;
                        $iva = $valor / $sal->saldo_ini;
                        $iva_inv =  $contribucion->ImportePago;
                        $valor_des = $sal->descargo * $contribucion->ImportePago;
                        $iva_des = $valor_des / $sal->saldo_ini; 
                    }
                }
                Balance::find($sal->id)->update(['descargo' => round($descargo, 2),  'saldo' => round($saldo, 2), 'iva' => round($iva, 2), 'iva_inv' => round($iva_inv, 2), 'iva_des' => round($iva_des, 2)]);                             
            }                
        }
        $discharge->status = 0;
        $discharge->save();
    }

}