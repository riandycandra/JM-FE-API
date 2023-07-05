<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    /**
     * failedValidation
     *
     * @param  mixed $validator
     * @return void
     */
    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => $validator->errors()->all()
        ], 422));
    }

    /**
     * failedAuthorization
     *
     * @return void
     */
    public function failedAuthorization(): void
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message'=> 'You are not allowed to perform this action.'
        ], 403));
    }
}
