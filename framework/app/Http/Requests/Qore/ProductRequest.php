<?php

namespace App\Http\Requests\Qore;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if(is_null($this->route('product')))
            $id = NULL;
        else
            $id = $this->route('product')->id;

        return [
            'name' => 'required|max:80',
            'description' => 'required|max:255',
            'logo' => 'nullable|image:jpg',
            'version' => 'nullable|numeric',
            'date' => 'required|date',
            'date_close' => 'required|date',
            'type' => 'required|in:product,service',
            'master_id' => 'required|integer',
            'price' => 'required|numeric'
        ];

    }
}
