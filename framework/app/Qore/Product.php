<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;

use App\Sentry\Module;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = ['name', 'description', 'logo', 'version', 'date', 'date_close', 'type', 'master_id', 'price'];
	protected $guarded  =  ['id','created_at','updated_at'];

    public static function toggleStatus($product)
    {
        if($product->status == 1)
    		$product->status = 0;
    	else
    		$product->status = 1;

    	$product->save();
    }

    public function setVersionAttribute($value)
    {
        if(empty($value))
        {
            $this->attributes['version'] = 1.0;
        }
    }

    public function module()
    {
        return $this->belongsTo('App\Setup\Module');
    }

    public static function getValidProducts()
    {
        $items = Product::where('master_id', auth()->user()->master_id)->get();
        $products = array();
        foreach($items as $item)
        {
            if($item->suite == 1)
            {
                $module = Module::find($item->module_id);
                if($module->nivel == 3)
                {
                    $products[] = $item;
                }
            } 
            else 
            {
                $products[] = $item;
            }
        } 
        return $products;
    }
}
