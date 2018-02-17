<?php

namespace App\Sentry;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Sentry\Module;
use App\Qore\Product;

class Suite extends Model
{
    use softDeletes;

    protected $connection = 'mysql';
    protected $table = "suites";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["master_id", "module_id", "active"];
    protected $dates = ["deleted_at"];

    public function modules()
    {
        return $this->belongsTo('App\Sentry\Module', 'module_id', 'id');
    }

    public function master()
    {
        return $this->belongsTo('App\Sentry\Master');
    }

    public function activateOrRegister()
    {
        $product = \DB::table('products')->where('master_id', $this->master_id)->where('module_id', $this->module_id)->first();

        if( count($product) == 0 )
        {
            $product = new Product;
            $product->name = $this->module->name;
            $product->description = $this->module->description;
            $product->version = $this->module->version;
            $product->date = date('Y-m-d');
            $product->date_close = date('Y-m-d');
            $product->type = "product";
            $product->master_id = $this->master_id;
            $product->suite = $this->id;
            $product->module_id = $this->module->id;
            $product->save();
        }
        else
        {
            $product = Product::findOrFail($product->id);
            $product->restore();
        }

        return $this->module->name." activado y agregago a los productos de ".$this->master->name;
    }

    public function lockOrRegister()
    {
        $product = \DB::table('products')->where('master_id', $this->master_id)->where('module_id', $this->module_id)->first();

        if( count($product) == 0 )
        {
            $product = new Product;
            $product->name = $this->module->name;
            $product->description = $this->module->description;
            $product->version = $this->module->version;
            $product->date = date('Y-m-d');
            $product->date_close = date('Y-m-d');
            $product->type = "product";
            $product->master_id = $this->master_id;
            $product->suite = $this->id;
            $product->module_id = $this->module->id;
            $product->save();
        }
        else
        {
            $product = Product::findOrFail($product->id);
            $product->delete();
        }

        return $this->module->name." desactivado y quitado los productos de ".$this->master->name;
    }

}
