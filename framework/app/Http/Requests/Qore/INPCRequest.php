<?php

namespace App\Http\Requests\Qore;

use Illuminate\Foundation\Http\FormRequest;

class INPCRequest extends FormRequest
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
            "inp_anio" => "required",
            "inp_periodo" => "required",
            "inp_valor" => "required",
            "inp_recargo" => "nullable"
        ];
    }
}
