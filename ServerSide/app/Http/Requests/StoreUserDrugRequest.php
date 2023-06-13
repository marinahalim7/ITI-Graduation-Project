<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class StoreUserDrugRequest extends FormRequest
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
            'img'=>'required',
            'exp_date'=>'required|date',
            'exp_img'=>'required',
            'price'=>'required|numeric',
            'quantity'=>'required|numeric',
            'user_id'=>'required|numeric',
            //'drug_id'=>'required|numeric',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
       
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422));
        

       
    }
}
