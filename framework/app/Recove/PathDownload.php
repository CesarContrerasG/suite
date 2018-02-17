<?php 
namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;


class PathDownload extends Model{

    protected $connection = 'mysql';
	protected $table = 'config_dir';
	protected $fillable = ['type','path','user','password'];
    public $timestamps = false;

    public static function fillData($request)
    {
        $emp = session()->get('company');
		$user = ''; $password = '';
		if($request->type == 1)
		{
			$user = $request->get('user');
			$password = $request->get('password');
		}
    	$data = [
			'type' => $request->type,
    		'path' => $request->get('path'),
    		'user' => $user,
    		'password' => $password,
    		'company' => $emp
    	];

        return $data;
    }

	public static function readDirs($path, $company)
	{
		if(is_dir($path))
		{
            if($dir = opendir($path))
			{
                while($item = readdir($dir)) 
				{
                    if($item != 'm3')
                    {   
                        $newPath = $path."/".$item;
                        if(is_dir($newPath) && $item != '.' && $item != '..') {
            	            PathDownload::readDirs($newPath, $company);
							
                        }
						$ext = strtolower(substr($newPath, strrpos($newPath, '.') + 1));
						if($newPath != '.' && $newPath != '..' && $newPath != '.htaccess' && ($ext == 'xml' || $ext == 'pdf'))
						{
							$date_file = date("d-m-Y", filemtime($newPath));
                            $now = date("d-m-Y");
							if($date_file == $now)
                            {
								$directory = PathDownload::where('company', $company)->first();
								if(!is_null($directory))
								{
									$ftp_server = $directory->path;
									$ftp_user_name = $directory->user;
									$ftp_user_pass = $directory->password;
									$conn_id = ftp_connect($ftp_server); 
									$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
									if ((!$conn_id) || (!$login_result)) { 
										echo "Conexión al FTP con errores!";
										echo "Intentando conectar a $ftp_server for user $ftp_user_name"; 
										exit; 
									} else {
										echo "Conectado a $ftp_server, for user $ftp_user_name";
									}

									@ftp_mkdir($conn_id, $ext);
									$upload = ftp_put($conn_id, $ext.'/'.$item, $newPath, FTP_BINARY);
									if (!$upload) { 
										echo "Error al subir el archivo!";
									} else {
										echo "Archivo se ha subido exitosamente a $ftp_server ";
									}
									ftp_close($conn_id);
								}
							}
						}
                    }
                }
				closedir($dir);
            }
    	}
	}
}

