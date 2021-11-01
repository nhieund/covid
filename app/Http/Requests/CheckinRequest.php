<?php
namespace App\Http\Requests;

class CheckinRequest extends ApiValidationRequest
{
    public function rules()
    {
        return [
            'employee_id'   => 'required|integer|min:1|max:100',
            'temperature'   => 'required|numeric|min:30|max:40',
        ];
    }
}
