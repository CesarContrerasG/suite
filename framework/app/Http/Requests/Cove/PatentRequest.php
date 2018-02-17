<?php

namespace App\Http\Requests\Cove;

use Illuminate\Foundation\Http\FormRequest;

class PatentRequest extends FormRequest
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
            'pk_age' => 'required|max:4',
            'age_razon' => 'required',
            'age_rfc' => 'required',
            'age_calle' => 'max:100',
            'age_mail' => 'email',
            'age_pais'   => 'max:3'
        ];
    }
}
