<?php 

namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;
use App\Cove\Detail;


class Inventory extends Model{

    protected $connection = 'default';
    protected $table = 'cove_mercancia';
    protected $guarded  =  ['pk_item'];
    protected $primaryKey='pk_item';
    public $timestamps = false;


    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }

    public function cove()
    {
        return $this->belongsTo('App\Cove\Cove', 'pk_item');
    }

    public function details()
    {
        return $this->hasMany('App\Cove\Detail', 'pk_item');
    }

    public static function insertOrUpdate($request)
    {
        if($request->pk_item == "")
            $inventory = new Inventory;
        else
            $inventory = Inventory::find($request->pk_item);

        $sec = Inventory::where('inv_item', $request->inv_item)->orderBy('inv_sec', 'desc')->first();        
        
        if($request->pk_item == "")
        {
            if(is_null($sec))
                $secuencial = 0;
            else
                $secuencial = $sec->inv_sec; 
            $secuencial = $secuencial + 1;
        }
        else
        {
            $secuencial = $inventory->inv_sec;
        }
        $invoice = Invoice::where('pk_item', $request->inv_item)->where('inv_factura', $request->inv_factura)->first();
        $moneda = '';
        if(!is_null($invoice))
        {
            $prefijo = explode('-', $invoice->inv_moneda);
            $moneda = $prefijo[0];
        }
            
        $inventory->inv_factura = $request->inv_factura;
        $inventory->inv_item = $request->inv_item;
        $inventory->inv_cove = $request->inv_cove;
        $inventory->inv_numparte = $request->inv_numparte;
        $inventory->inv_descove = $request->inv_descove;
        $inventory->inv_oma = $request->inv_oma;
        $inventory->inv_moneda = $moneda;
        $inventory->inv_cantidad = $request->inv_cantidad;
        $inventory->inv_valorunitario = $request->inv_valorunitario;
        $inventory->inv_valortotal = $request->inv_valortotal;
        $invoice = Invoice::where('pk_item', $request->inv_item)->first();
        $import_usd = $request->inv_valortotal * ($invoice->inv_factorme);
        $inventory->inv_valorusd = $import_usd;
        $inventory->inv_sec = $secuencial;
        $inventory->inv_bultos = $request->inv_bultos;
        $inventory->save();
    }

    public static function import($handle, $request)
    {
        $sec = 0;
        $cont = 0;
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE)
        {                   
            $cove = $request->pk_cove;   
            if($request->overwrite == 'on' && $cont == 0)
                Inventory::where('inv_item', $cove)->where('inv_factura', $data[1])->where('inv_numparte', $data[2])->delete();
               
            /*if(!is_null($cove))
            { */                       
                $inventory_exist = Inventory::where('inv_item', $cove)->orderBy('inv_sec', 'desc')->first();
                if(!is_null($inventory_exist))
                    $sec = $inventory_exist->inv_sec;
                $inventory = new Inventory;                        
                $inventory->inv_factura = $data[1];
                $inventory->inv_item = $cove;
                $inventory->inv_cove = $data[0];
                $inventory->inv_numparte = $data[2];
                $inventory->inv_descove = $data[3];
                $inventory->inv_oma = $data[4];
                $inventory->inv_cantidad = $data[5];
                $inventory->inv_valorunitario = $data[6];
                $inventory->inv_valortotal = $data[7];
                $inventory->inv_valorusd = $data[8];
                $inventory->inv_sec = $sec + 1;
                $inventory->save();
                $detail = Detail::where('inv_item', $inventory->pk_item)->first();
                if(is_null($detail))
                    $detail = new Detail;
                $detail->inv_cove = $data[0];
                $detail->inv_item = $inventory->pk_item;
                $detail->inv_marca = $data[9];
                $detail->inv_modelo = $data[10];
                $detail->inv_submodelo = $data[11];
                $detail->inv_noserie = $data[12];
                $detail->save();

            //}    
            $cont++;
        }
    }
}