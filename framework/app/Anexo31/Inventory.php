<?php 
namespace App\Anexo31;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Inventory extends Model{

    protected $connection = 'default';
    protected $table = 'inventario_inicial';
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }

    public static function insertData($file, $folio, $rect)
    {     
        if($file->getClientOriginalExtension() == 'txt')
            $file->storeAs('/', $file->getClientOriginalName(),'documents'); 
            
        $dir = \Storage::disk('documents')->getDriver()->getAdapter()->getPathPrefix();
        $archivo = $dir.'/'.$file->getClientOriginalName();
        
        foreach(file($archivo) as $line) 
        {
            $field = explode("|",$line);     
            if(isset($field[8]))      
                $anterior = $field[8];
            else
                $anterior = '';
                    
            $data = [
                'tipo' => $field[0],               
                'patente' => $field[1],
                'pedimento' => $field[2],
                'aduana' => $field[3],
                'fecha' => $field[4],
                'fraccion' => $field[5],
                'saldo' => $field[6],
                'afijo' => $field[7],
                'folio' => $anterior,
                'folio_original' => $folio
            ];

            if(($rect == 1 && $field[0] == '09') || ($rect != 1 && $field[0] == '01'))
            {
                $exis_reg = 0;
                if($rect == 1)
                {
                    Inventory::where('folio_original', $field[8])->update(['status' => 0]);
                    $exis_reg = Inventory::where('aduana', $field[3])->where('patente', $field[1])->where('pedimento', $field[2])->where('fraccion', $field[5])->where('folio', $field[8])->count();                    
                    Balance::where('tipo', 1)->delete();
                    Balance::where('tipo', 2)->update(['descargo' => 0, 'saldo' => 0, 'iva' => 0]);
                }
                if($exis_reg == 0)
                    Inventory::insert($data);
            }
                
        }
                           
    }   
}

     