<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiValidationRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $response = [
            'errCode' => 422,
            'errMsg'      => $validator->errors()->toArray(),
        ];

        throw new HttpResponseException(response()->json($response));
    }
}
