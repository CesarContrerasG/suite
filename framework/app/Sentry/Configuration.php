<?php

namespace App\Sentry;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configuration extends Model
{
    use SoftDeletes;

    protected $table = "configurations";
    protected $fillable = ["prefix_db", "iva", "notifications_days", "master_id", "website", "primary_color", "secundary_color", "contact_support", "email_support", "contact_sales", "email_sales", "contact_admon", "email_admon", "to_company", "sector"];
    protected $dates = ["deleted_at"];

    public static function createDB($contract, $configuration)
    {
        $prefix = "";
        if(count($configuration) > 0){
            $prefix = $configuration->prefix_db;
        }

        $servername = "localhost";
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $namedb = $prefix.$contract->master->db;
        try {
            $conn = new \PDO("mysql:host=$servername;dbname=information_schema", $username, $password);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE IF NOT EXISTS {$namedb}";
            $conn->exec($sql);
            $conn = null;
            return "Database created successfully";
        }
        catch(PDOException $e) {
            return $sql . "<br>" . $e->getMessage();
            //$conn = null;
        }
    }

    public static function createTables($contract, $configuration, $scripts)
    {
        $prefix = "";
        if(count($configuration) > 0){
            $prefix = $configuration->prefix_db;
        }
        $servername = "localhost";
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $namedb = $prefix.$contract->master->db;

        try {
            $conn = new \PDO("mysql:host=$servername;dbname={$namedb}", $username, $password);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            foreach ($scripts as $script) {
                $stmt = $conn->prepare($script);
                $stmt->execute();
            }

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

        return true;
    }
}
