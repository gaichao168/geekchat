<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = new  JsonResponse([
            'code'=>'1111',
            'message'=>'参数错误',
            'errors'=>$errors
        ],422);
        throw new HttpResponseException($response);
    }
}
