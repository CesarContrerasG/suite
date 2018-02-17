<?php

namespace App\Http\Requests\Cove;

use Illuminate\Foundation\Http\FormRequest;

class AssetRequest extends FormRequest
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
            'pk_af' => 'required|max:30',
            'af_codigoprov' => 'max:30',
            'af_desc' => 'required|max:200',
            'af_descove' => 'required|max:256|regex:/^([a-zA-Z0-9\/._-])+((\s*)+([a-zA-Z0-9\/._-]*)*)+$/',
            'af_fracc' => 'required|regex:/\b\d{4}[.]?\d{2}[.]?\d{2}\b/',
            'af_umc' => 'required|min:1',
            'af_oma' => 'required',
            'af_marca'   => 'max:80',
            'af_modelo'   => 'max:80',
            'af_tipo' => 'required',
            'af_orden' => 'max:20',
            'af_serie' => 'max:40'
        ];
    }
}
