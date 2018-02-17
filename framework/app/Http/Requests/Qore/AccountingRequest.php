<?php

namespace App\Http\Requests\Qore;

use Illuminate\Foundation\Http\FormRequest;

class AccountingRequest extends FormRequest
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
            'date_payment' => 'required|date',
            'type' => 'required|numeric|in:1,0',
            'invoice_number' => 'required',
            'check_number' => 'nullable',
            'tax_sheet' => 'nullable',
            'client' => 'nullable|max:80',
            'description' => 'required',
            'date_emition' => 'nullable|date',
            'amount' => 'required|numeric',
            'iva' => 'nullable|numeric',
            'way_to_pay' => 'required|numeric'
        ];
    }
}
