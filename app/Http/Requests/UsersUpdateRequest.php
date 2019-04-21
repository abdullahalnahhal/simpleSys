<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersUpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$this->route('id').',id',
            'password' => 'nullable|string|same:password_confirm',
            'password_confirm' => 'nullable',
            'role' => 'required|exists:roles,id',
        ];
    }
    public function messages()
    {
        return [
          'name.required' => 'Name Must Be Filled First',
          'email.required' => 'User Name Must Be Filled First ',
          'password.required' => 'Password Must Be Filled First',
          'password_confirm.required' => 'Password Confirmation Must Be Filled First',
          'role.required' => 'You Must Select User Role First',
          'email.unique' => 'These User Name Taken Before, User Name Must Be Unique',
          'email.email' => 'Email Must Be In True Format',
          'password.same' => 'Password Must Match The Confirm Field',
          'role.exists' => 'You Must Select User Role First',
        ];
    }
}
