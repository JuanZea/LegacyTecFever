<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveShoppingCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required',
            'amount' => 'bail|required|min:1|max:1000'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() : array
    {
        return [
            'amount.min:1' => __("Quantities must be positive")
        ];
    }
}
