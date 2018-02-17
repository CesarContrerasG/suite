<?php 
namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Seal extends Model{
    
    protected $connection = 'default';    
	protected $table = 'caem16';
	protected $fillable = ['pk_emp','sello_rfc','sello_key','sello_cer','sello_vigencia','sello_password','sello_wsp','sello_key64','sello_cer64','sello_vigencia'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = User::changeConnection();          
        $this->connection = $bd;
    }
    
    public function getRouteKeyName()
    {
        return 'pk_item';
    }

	public static function openkey($request)
	{
        $carpeta = base_path().'/public/apps/sellos';
        $rfc = $request->input('sello_rfc');
		$password = $request->input('sello_password');
        $seals = ['sello_cer' => $request->file('sello_cer')->getClientOriginalName(), 'sello_key' => $request->file('sello_key')->getClientOriginalName()];
        $vigencia = '';
        $data = [];
        foreach ($seals as $seal => $name) 
        {
            
            $request->file($seal)->move($carpeta,$name); 

            if($seal == 'sello_key')
            {
                $linea_pem = "openssl pkcs8 -inform DER -in " . $carpeta."/".$name . " -passin pass:" . $password . " -out ".$carpeta."/pkey_".$rfc.".pem";
                $file_pem = "pkey_".$rfc.".pem";
            }
            else
            {
                $linea_pem = "openssl x509 -inform DER -outform PEM -in " . $carpeta."/".$name. " -pubkey > ".$carpeta."/certificado_".$rfc.".pem";       
                $file_pem = "certificado_".$rfc.".pem";
            }
            exec($linea_pem);
            if(filesize($carpeta.'/'.$file_pem) > 0)
            {
                $value[$seal] = addslashes(fread(fopen($carpeta.'/'.$file_pem, "rb"),filesize($carpeta.'/'.$file_pem)));
                if($seal = 'sello_cer')
                {   
                    $start = strpos($value[$seal], '-----BEGIN CERTIFICATE-----') + 28;
                    $finish = strpos($value[$seal], '-----END CERTIFICATE-----');
                    $len_cert = $finish - $start;
                    $cert64 = substr($value[$seal],$start,$len_cert);
                }                  
            }
                        
        } 
        if(filesize($carpeta."/certificado_".$rfc.".pem") > 0)
        {
            exec("openssl x509 -in ".$carpeta."/certificado_".$rfc.".pem -enddate -subject -serial > ".$carpeta."/vigencia_".$rfc.".txt");
            $vigencia_base64 =addslashes(fread(fopen($carpeta.'/vigencia_'.$rfc.'.txt', "rb"),filesize($carpeta.'/vigencia_'.$rfc.'.txt')));
            $iniciafecha = strpos($vigencia_base64, 'notAfter=') + 9;
            $finfecha = strpos($vigencia_base64, 'GMT') - 1;
            $mes = substr($vigencia_base64,$iniciafecha,3);
            $dia = substr($vigencia_base64,$iniciafecha+4,2);
            $ano = substr($vigencia_base64,$finfecha-4,4);
            $fecha = $ano ."-" . $mes . "-" . $dia;
            $vigencia = date('Y-m-d',strtotime($fecha));
        }
        if(filesize($carpeta."/pkey_".$rfc.".pem") > 0)
        {
    	    $data = [
                'pk_emp'      => $this->connection,
                'sello_rfc'   => $rfc,
                'sello_cer'   => $seals['sello_cer'],
                'sello_key'   => $seals['sello_key'],
                'sello_password' => $password,
                'sello_wsp'   => $request->input('sello_wsp'),
     	        'sello_cer64' => $cert64,
    	        'sello_key64' => $value['sello_key'],
                'sello_vigencia' => $vigencia
            ];

        }
     
        return $data;
    }
}
