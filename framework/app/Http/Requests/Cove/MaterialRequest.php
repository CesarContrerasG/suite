<?php

namespace App\Http\Requests\Cove;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
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
            'pk_mat' => 'required|max:30',
            'mat_codigoprov' => 'max:30',
            'mat_des' => 'required|max:200',
            'mat_descove' => 'required|max:256|regex:/^([a-zA-Z0-9\/._-])+((\s*)+([a-zA-Z0-9\/._-]*)*)+$/',
            'mat_fracci' => 'required|regex:/\b\d{4}[.]?\d{2}[.]?\d{2}\b/',
            'mat_umc' => 'required|min:1',
            'mat_oma' => 'required',
            'mat_pesounitario'   => 'required|numeric',
            'mat_tipo' => 'required',
            'mat_fechai' => 'date',
            'mat_fechaf' => 'date|after:mat_fechai'
        ];
    }
}
