<?php

namespace App\Http\Requests\Qore;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersRequest extends FormRequest
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
        if(is_null($this->route('user')))
            $id = NULL;
        else
            $id = $this->route('user')->id;

        return [
            'name' => 'required|max:20',
            'last_name' => 'required|max:30',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6|max:16',
            'avatar' => 'nullable',
            'departament_id' => 'required|integer',
            'master_id' => 'required|integer'
        ];
    }
}
