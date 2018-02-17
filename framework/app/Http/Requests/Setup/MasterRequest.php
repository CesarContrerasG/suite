<?php

namespace App\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;

class MasterRequest extends FormRequest
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
        if(is_null($this->route('master')))
            $id = NULL;
        else
            $id = $this->route('master')->id;

        return [
            'name' => 'required|max:30',
            'business_name' => 'required|max:255',
            'rfc' => 'required|max:30',
            'contact' => 'nullable|max:255|email',
            'logo' => 'nullable|image:jpg',
            'address' => 'required',
            'outdoor' => 'required|max:10',
            'interior' => 'max:10',
            'colony' => 'required|max:200|min:3',
            'location' => 'nullable|max:200',
            'town' => 'required|max:200:min:3',
            'state' => 'required|max:200|min:3',
            'pcode' => 'required|max:10|min:3',
            'country' => 'required|max:3',
            'phone' => 'nullable|max:20',
            'sector' => 'required|integer',
            'curp' => 'nullable|max:20',
            'type' => 'required|integer',
        ];
    }
}
