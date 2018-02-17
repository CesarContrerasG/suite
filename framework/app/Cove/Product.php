<?php
namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Product extends Model
{
    protected $connection = 'default';
    protected $table = "caem03";
	protected $guarded  =  ['pk_item'];
    protected $primaryKey='pk_item';
    public $timestamps = false;
    
    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }
    
    public function getShortDescriptionAttribute()
    {
        return substr($this->prod_descove, 0, 15)."...";
    }

    public static function insertOrUpdate($product, $request)
    {
        $product->pk_prod = $request->pk_prod;
        $product->prod_codigoprov = $request->prod_codigoprov;
        $product->prod_des = $request->prod_des;
        $product->prod_descove = $request->prod_descove;
        $product->prod_pesounitario = $request->prod_pesounitario;
        $product->prod_fracci = $request->prod_fracci;
        $product->prod_umc = $request->prod_umc;
        $product->prod_oma = $request->prod_oma;
        $product->prod_tipo = $request->prod_tipo;
        $product->prod_fechai = $request->prod_fechai;
        $product->prod_fechaf = $request->prod_fechaf;
        $product->save();
    }
}