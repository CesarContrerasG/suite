<?php

namespace App\Http\Requests\Cove;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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
            'pk_pro' => 'required|max:20',
            'pro_razon' => 'required',
            'pro_tipo' => 'required|in:1,2',
            'pro_calle' => 'required',
            'pro_col' => 'required',
            'pro_cp' => 'required',
            'pro_mpo' => 'required',
            'pro_noext' => 'required',
            'pro_pais'   => 'required|max:3'
        ];
    }
}
