<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RuasRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ruas_name' => 'required|string|max:255',
            'long'      => 'required|string|integer',
            'km_awal'   => 'required|string|max:255',
            'km_akhir'  => 'required|string|max:255',
            'photo'     => 'required|file|mimes:jpeg,jpg,bmp,png,gif|max:5120',
            'file'      => 'required|file|mimes:pdf,docx,pptx,xlsx|max:5120',
            'unit_id'   => 'required|integer|exists:unit,id',
            'status'    => 'required|in:0,1',
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => $validator->errors()->all()
        ], 422));

    }
}
