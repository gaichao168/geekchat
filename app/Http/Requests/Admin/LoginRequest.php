<?php

namespace App\Http\Requests\Admin;


class LoginRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'account'=>'required',
            'password'=>'required'
        ];
    }

    public function messages()
    {
        return [
          'account.required'=>'请输入账号',
          'password.required'=>'请输入密码'
        ];
    }




}
