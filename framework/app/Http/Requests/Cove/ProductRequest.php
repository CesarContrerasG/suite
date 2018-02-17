<?php

namespace App\Http\Requests\Cove;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'pk_prod' => 'required|max:30',
            'prod_codigoprov' => 'max:30',
            'prod_des' => 'required|max:200',
            'prod_descove' => 'required|max:256',
            'prod_fracci' => 'required|regex:/\b\d{4}[.]?\d{2}[.]?\d{2}\b/',
            'prod_umc' => 'required|min:1',
            'prod_oma' => 'required',
            'prod_pesounitario'   => 'required|numeric',
            'prod_tipo' => 'required',
            'prod_fechai' => 'date',
            'prod_fechaf' => 'date|after:prod_fechai'
        ];
    }
}
