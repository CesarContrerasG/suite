<?php

namespace App\Sentry;

use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
    public static function nivelsModules()
    {
        $nivels = [1 => "Own", 2 => "Account", 3 => "Clients"];
        return $nivels;
    }

    public static function nivelsUsers()
    {
        $nivels = [0 => "Owner"];
        $nivels_db = \DB::table('types')->pluck('name', 'id');
        $nivels = $nivels + $nivels_db->toArray();
        return $nivels;
    }

    public static function toggleAuthorize($user)
    {
        $hash = \Hashids::connection('security')->decode($user->extra)[0];
        if($user->id == $hash){
            $user->extra = NULL;
        } else {
            $user->extra = \Hashids::connection('security')->encode($user->id);
        }

        $user->save();
        return true;
    }

}
