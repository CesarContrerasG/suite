<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dates extends Model
{
    use SoftDeletes;

    protected $table = "contract_dates";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["contract_id", "credit_days", "revision_day", "revision_time", "payment_day", "payment_time", "opening_date", "ending_date"];
    protected $dates = ["deleted_at"];

    public function getRevisionWeekdayAttribute()
    {
        switch ($this->revision_day) {
            case 1:
                return "Lunes";
                break;
            case 2:
                return "Martes";
                break;
            case 3:
                return "Miercoles";
                break;
            case 4:
                return "Jueves";
                break;
            case 5:
                return "Viernes";
                break;
            case 6:
                return "Sabado";
                break;
            case 7:
                return "Domingo";
                break;
            default:
                return "Lunes";
                break;
        }
    }

    public function getPaymentWeekdayAttribute()
    {
        switch ($this->payment_day) {
            case 1:
                return "Lunes";
                break;
            case 2:
                return "Martes";
                break;
            case 3:
                return "Miercoles";
                break;
            case 4:
                return "Jueves";
                break;
            case 5:
                return "Viernes";
                break;
            case 6:
                return "Sabado";
                break;
            case 7:
                return "Domingo";
                break;
            default:
                return "Lunes";
                break;
        }
    }
}
