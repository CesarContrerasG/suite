<?php

namespace App\Http\Requests\Qore;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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
            'master_id' => 'required|integer',
            'company_id' => 'required|integer',
            'conditions' => 'nullable',
            'credit_days' => 'required',
            'opening_date' => 'required|date',
            'ending_date' => 'required|date'
        ];
    }
}
