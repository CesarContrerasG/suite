<?php

namespace App\Http\Requests\Cove;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'pk_cli' => 'required|max:20',
            'cli_razon' => 'required',
            'cli_tipo' => 'required|in:1,2',
            'cli_calle' => 'required',
            'cli_col' => 'required',
            'cli_cp' => 'required',
            'cli_mpo' => 'required',
            'cli_noext' => 'required',
            'cli_pais'   => 'required|max:3'
        ];
    }
}
