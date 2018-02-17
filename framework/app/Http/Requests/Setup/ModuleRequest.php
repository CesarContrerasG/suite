<?php

namespace App\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'version' => 'required',
            'url' => 'required',
            'color' => 'required',
            'database' => 'numeric|in:0,1',
            'script' => 'nullable',
            'logo' => 'nullable',
            'nivel' => 'numeric|in:1,2,3'
        ];
    }
}
