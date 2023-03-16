<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class EditCampaignRequest extends FormRequest
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
            'SpecificAuthorCampaign' => 'required',
            'SpecificAuthorCampaign.rule.author_id' => 'required|numeric',
            'SpecificAuthorCampaign.rule.order_product_quantity' => 'required|numeric',
            '*.name' => 'required|string',
            '*.discount' => 'required|numeric',
            '*.rule' => 'required',

            'DomesticAuthorCampaign' => 'required',
            'DomesticAuthorCampaign.rule.authorType' => ['required', Rule::in(['Yerli','Yabancı'])],

            'TotalPriceCampaign' => 'required',
            'TotalPriceCampaign.rule.total_price' => 'required|numeric',

        ];
    }
}
