<?php

namespace App\Http\Requests\Admin;

class UpVipRequest extends BaseRequest
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
            'user_id'=>'required|exists:wechat_users,id',
            'month'=>'required|integer|between:1,12'
        ];
    }

}
