<?php

namespace App\Http\Requests\Qore;

use Illuminate\Foundation\Http\FormRequest;

class DepartamentRequest extends FormRequest
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
        if(is_null($this->route('departament')))
            $id = NULL;
        else
            $id = $this->route('departament')->id;

        return [
            'name' => 'required|max:80',
            'description' => 'required',
            'company_id' => 'required|integer',
            'status' => 'required'
        ];
    }
}
