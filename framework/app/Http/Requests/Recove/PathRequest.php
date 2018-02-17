<?php

namespace App\Http\Requests\Recove;

use Illuminate\Foundation\Http\FormRequest;

class PathRequest extends FormRequest
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
            'type' => 'required',
            'path' => 'required',
            'user' => 'required_if:type,1',
            'password' => 'required_if:type,1'
        ];

    }
}
