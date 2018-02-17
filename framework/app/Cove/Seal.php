<?php 
namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Seal extends Model{
    
    protected $connection = 'default';    
    protected $table = 'caem16';
    protected $fillable = ['pk_emp','sello_rfc','sello_key','sello_cer','sello_vigencia','sello_password','sello_wsp','sello_key64','sello_cer64','sello_vigencia'];
    protected $primaryKey = 'pk_item';
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }
    
    public function getRouteKeyName()
    {
        return 'pk_item';
    }

    public static function data($request)
    {
        $carpeta =  storage_path().'/seals';
        $rfc = $request->sello_rfc;
        $password = $request->sello_password;
        $seals = ['sello_cer' => $request->file('sello_cer')->getClientOriginalName(), 'sello_key' => $request->file('sello_key')->getClientOriginalName()];
        $vigencia = '';
        $data = [];
        $company = auth()->user()->current_master->name;
        foreach ($seals as $seal => $name) 
        {            
            //\Storage::disk('seals')->put($name,  $request->file($seal)); // carpeta para guardar sellos
            $request->file($seal)->storeAs("/", $request->file($seal)->getClientOriginalName(), 'seals');
            if($seal == 'sello_key')
            {
                $linea_pem = "/usr/local/apps/bin/openssl pkcs8 -inform DER -in " . $carpeta."/".$name . " -passin pass:" . $password . " -out ".$carpeta."/pkey_".$rfc.".pem";
                $file_pem = "pkey_".$rfc.".pem";
            }
            else
            {
                $linea_pem = "/usr/local/apps/bin/openssl x509 -inform DER -outform PEM -in " . $carpeta."/".$name. " -pubkey > ".$carpeta."/certificado_".$rfc.".pem";       
                $file_pem = "certificado_".$rfc.".pem";
            }
            exec($linea_pem, $output, $return);
        
            if(filesize($carpeta.'/'.$file_pem) > 0)
            {
                $value[$seal] = addslashes(fread(fopen($carpeta.'/'.$file_pem, "rb"),filesize($carpeta.'/'.$file_pem)));
                if($seal = 'sello_cer')
                {   
                    $start = strpos($value[$seal], '-----BEGIN CERTIFICATE-----') + 28;
                    $finish = strpos($value[$seal], '-----END CERTIFICATE-----');
                    $len_cert = $finish - $start;
                    $cert64 = substr($value[$seal],$start,$len_cert); //certificado base_64
                    $vigencia = Seal::calculateVigencia($carpeta, $file_pem, $rfc);                    
                }                  
            }
                        
        } 
        $data = [
            'pk_emp'      => $company,
            'sello_rfc'   => $rfc,
            'sello_cer'   => $seals['sello_cer'],
            'sello_key'   => $seals['sello_key'],
            'sello_password' => $password,
            'sello_wsp'   => $request->sello_wsp,
            'sello_cer64' => $cert64,
            'sello_key64' => $value['sello_key'],
            'sello_vigencia' => $vigencia
        ];
        
        return $data;
    }

    public static function calculateVigencia($carpeta, $file, $rfc)
    {
        exec("/usr/local/apps/bin/openssl x509 -in ".$carpeta."/certificado_".$rfc.".pem -enddate -subject -serial > ".$carpeta."/vigencia_".$rfc.".txt");
        $vigencia_base64 =addslashes(fread(fopen($carpeta.'/vigencia_'.$rfc.'.txt', "rb"),filesize($carpeta.'/vigencia_'.$rfc.'.txt')));
        $iniciafecha = strpos($vigencia_base64, 'notAfter=') + 9;
        $finfecha = strpos($vigencia_base64, 'GMT') - 1;
        $mes = substr($vigencia_base64,$iniciafecha,3);
        $dia = substr($vigencia_base64,$iniciafecha+4,2);
        $ano = substr($vigencia_base64,$finfecha-4,4);
        $fecha = $ano ."-" . $mes . "-" . $dia;
        $vigencia = date('Y-m-d',strtotime($fecha));
        
        return $vigencia;
    }

    public static function encrypt($cadena, $seal)
    {
        $pkeyid = openssl_get_privatekey($seal->sello_key64);
        $expedicion = explode("-", $seal->sello_vigencia);  
        $anio = $expedicion[0] - 4;
        $mes = $expedicion[1];
        if($anio == '2015')
        {   
            if($mes >= 6)
                openssl_sign($cadena, $crypttext, $pkeyid, OPENSSL_ALGO_SHA256);
            else
                openssl_sign($cadena, $crypttext, $pkeyid);
        }
        elseif($anio > '2015')
        {   
            openssl_sign($cadena, $crypttext, $pkeyid, OPENSSL_ALGO_SHA256);
        }
        else {          
            openssl_sign($cadena, $crypttext, $pkeyid);
        }          

        return $crypttext;
    }
}
