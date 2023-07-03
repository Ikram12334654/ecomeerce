<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productvalidatioin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
        'product_id' => 'required|unique:products,productid',
         'name'=> 'required',
        'price' => 'required|numeric',
        'description' => 'required',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        'coupon' => 'sometimes|nullable|alpha_num',

            
        ];
    }
    public function messages(): array
    {
        return [
            'productid.requied' => 'required|unique:products,product_id,',
        'name.requied' => 'required',
        'price.requied' => 'required|numeric',
        'description.requied' => 'required',
        'image.requied' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'coupon.requied' => 'nullable|alpha_num',

        ];
    }
}
