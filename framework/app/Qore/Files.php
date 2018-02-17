<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Files extends Model
{
    use SoftDeletes;

    protected $table = "contract_files";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["contract_id", "concept", "description", "emition_date", "document"];
    protected $dates = ["deleted_at"];

    public static function storageImage($request, $file, $master){
        if($request->hasFile('document'))
        {
            $year = date('Y', strtotime($request->get('emition_date')));
            $month = date('m', strtotime($request->get('emition_date')));
            $path = $master.'/'.$year.'/'.$month.'/contracts\/'.$file->id.'/';

            $request->file('document')->storeAs($path, $request->file('document')->getClientOriginalName(), 'qore');
        }

        return true;
    }
}
