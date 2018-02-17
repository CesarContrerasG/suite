<?php

namespace App\Http\Requests\Qore;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'pai_clavefiii' => 'required',
            'pai_clavem3' => 'required',
            'pai_nombre' => 'required'
        ];
    }
}
