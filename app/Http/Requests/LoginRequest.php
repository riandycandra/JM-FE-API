<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.*'    => 'Username or password is invalid',
            'password.*'    => 'Username or password is invalid',
        ];
    }
}
