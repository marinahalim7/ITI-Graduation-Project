<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class StoreStoreRequest extends FormRequest
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
            'name'=>'required',
            'slug'=>'',
            'password'=>'required|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
            'owner_SSN'=>'required|unique:stores|digits:14',
            'phone_num'=>'required|unique:stores|digits:11',
            'location_lat'=>'',
            'location_long'=>''
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
