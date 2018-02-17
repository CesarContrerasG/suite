<?php 

namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Detail extends Model{

    protected $connection = 'default';
    protected $table = 'cove_detalle';
    protected $guarded  =  ['pk_item'];
    protected $primaryKey='pk_item';
    public $timestamps = false;


    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }

    public function inventory()
    {
        return $this->belongsTo('App\Cove\Inventory', 'inv_item');
    }

    public static function insertOrUpdate($detail, $request)
    {
        $detail->inv_cove = $request->inv_cove;
        $detail->inv_item = $request->inv_item;
        $detail->inv_marca = $request->inv_marca;
        $detail->inv_modelo = $request->inv_modelo;
        $detail->inv_submodelo = $request->inv_submodelo;
        $detail->inv_noserie = $request->inv_noserie;
        $detail->save();
    }
}