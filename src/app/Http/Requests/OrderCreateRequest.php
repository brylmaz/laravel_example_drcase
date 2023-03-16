<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class OrderCreateRequest extends FormRequest
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
            '*.product_id.required' => 'Lütfen product_id degeri gönderiniz',
            '*.product_id.nullable' => 'Lütfen boş değer göndermeyiniz',
            '*.product_id.numeric' => 'Lütfen product_id değerini sayı olarak gönderiniz',

            '*.piece.required' => 'Lütfen piece degeri gönderiniz',
            '*.piece.nullable' => 'Lütfen boş değer göndermeyiniz',
            '*.piece.numeric' => 'Lütfen piece değerini  sayı olarak gönderiniz',
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
            '*.product_id' => 'bail|required|numeric|nullable',
            '*.piece' => 'bail|required|numeric|nullable',
        ];
    }
}
