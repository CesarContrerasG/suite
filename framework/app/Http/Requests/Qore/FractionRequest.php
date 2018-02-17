<?php

namespace App\Http\Requests\Qore;

use Illuminate\Foundation\Http\FormRequest;

class FractionRequest extends FormRequest
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
            "fra_fraccion" => "required",
            "fra_descrip1" => "required",
            "fra_descrip2" => "required",
            "fra_descrip3" => "required",
            "fra_unidad" => "required",
            "fra_advotr" => "required"
        ];
    }
}
