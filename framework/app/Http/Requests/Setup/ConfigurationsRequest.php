<?php

namespace App\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationsRequest extends FormRequest
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
            'prefix_db' => 'required',
            'iva' => 'required|integer',
            'notifications_days' => 'required|integer|min:3|max:30',
            'master_id' => 'required|integer',
            'website' => 'nullable|min:6|max:30',
            'primary_color' => 'nullable|min:7|max:7',
            'secundary_color' => 'nullable|min:7|max:7',
            'contact_support' => 'nullable|min:3|max:20',
            'email_support' => 'nullable|email',
            'contact_sales' => 'nullable|min:3|max:20',
            'email_sales' => 'nullable|email',
            'contact_admon' => 'nullable|min:3|max:20',
            'email_admon' => 'nullable|email',
            'to_company' => 'integer',
            'sector' => 'integer'
        ];
    }
}
