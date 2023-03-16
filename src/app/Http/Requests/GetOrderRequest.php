<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function messages()
    {
        return [
            '*.OrderNumber.required' => 'Lütfen OrderNumber degeri gönderiniz',
            '*.OrderNumber.nullable' => 'Lütfen boş değer göndermeyiniz',
            '*.OrderNumber.numeric' => 'Lütfen OrderNumber değerini sayı olarak gönderiniz',
        ];
    }

    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            '*.OrderNumber' => 'bail|required|numeric|nullable',

        ];
    }
}
