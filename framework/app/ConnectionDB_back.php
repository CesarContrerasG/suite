<?php
namespace App;

use App\Qore\Company;

class ConnectionDB
{
    public static function changeConnection()
    {
        $id = session()->get('company');
        $company = Company::find($id);
   
        $connection = [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '3306'),
            'database' =>  $company->db,
            'username' => 'secenet',
            'password' => 'adc1e991995f4e2e',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ];
        
        config(['database.connections.'.$company->name => $connection]);
        \DB::setDefaultConnection($company->name);
        
        return $company->name;
    }
   /* public static function connectionPedimento()
    {
        $company = \Auth::user()->master->company;
        $db = \Auth::user()->master->company->db;
        $connection = [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '3306'),
            'database' =>  $db,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ];
        config(['database.connections.pedimentos' => $connection]);
        \DB::setDefaultConnection('pedimentos');
    }*/

    public static function getFTPPath($emp,$path_ftp)
    {
        $data_ftp = \DB::connection('mysql')->table('config_dir')->where('company', $emp)->first();       
        $ftp_server = $data_ftp->ftp;
        $ftp_username   = $data_ftp->user;
        $ftp_password   =  $data_ftp->password;  


        $conn_id = @ftp_connect($ftp_server);
        if (@ftp_login($conn_id, $ftp_username, $ftp_password))
            $connect = $conn_id;
        else
            $connect = false;

        if($connect != false)
        {            
            @ftp_chdir($conn_id, '/'); 
            $parts = explode('/',$path_ftp); 
            foreach($parts as $part){
                if(!@ftp_chdir($conn_id, $part)){
                    ftp_mkdir($conn_id, $part);
                    ftp_chdir($conn_id, $part);
                }
            }      
   
        }
        return $connect;
             
    }
}
