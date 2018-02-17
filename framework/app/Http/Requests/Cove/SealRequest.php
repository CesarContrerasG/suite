<?php

namespace App\Http\Requests\Cove;

use Illuminate\Foundation\Http\FormRequest;

class SealRequest extends FormRequest
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
            "sello_key" => "required",
            "sello_cer" => "required",
            "sello_rfc" => "required",
            "sello_password" => "required",
            "sello_wsp" => "required"

        ];

    }
}
