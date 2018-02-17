<?php

namespace App\Http\Requests\Qore;

use Illuminate\Foundation\Http\FormRequest;

class IdentifierRequest extends FormRequest
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
            'ide_clave' => 'required',
            'ide_descrip' => 'required',
            'ide_nivel' => 'required',
            'ide_comp' => 'nullable'
        ];
    }
}
