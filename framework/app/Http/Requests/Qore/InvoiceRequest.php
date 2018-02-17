<?php

namespace App\Http\Requests\Qore;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            "payment_amount" => "required|numeric",
            "folio" => "required",
            "contract_id" => "required|integer",
            "billing_register" => "required|date",
            "pdf" => "nullable|file",
            "xml" => "nullable|file",
            "concepto" => "required"
        ];
    }
}
