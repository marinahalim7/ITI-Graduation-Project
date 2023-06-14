<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name'=>'required', 
            'last_name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
            'img'=>'required',
            'phone_num'=>'required|unique:users|digits:11'
        ];
    }

    
protected function failedValidation(Validator $validator){
    throw new HttpResponseException(
        response()->json([
            'success'=>false,
            'message'=>"Validation Error",
            'errors'=> $validator->errors(),
        ], 400));
}

function messages()
{
 return ['password' =>'The password field must contain numbers, special characters and 8 digits.'];
}
}
