<?php

namespace App\Http\Requests\Qore;

use Illuminate\Foundation\Http\FormRequest;

class FactorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "fmo_moneda" => "required",
            "fmo_equival"  => "required",
            "fmo_fecha" => "required"
        ];
    }
}
