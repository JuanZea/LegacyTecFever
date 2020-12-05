<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
//        return Auth::user()->isAdmin;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'name' => 'bail|required|min:3|max:60',
            'description' => 'bail|required|min:10|max:1000',
            'category' => 'bail|required|in:computer,smartphone,accessory',
            'image' => 'bail|nullable|image',
            'image_path' => 'bail|nullable|string',
            'price' => 'bail|required|digits_between:4,9',
            'stock' => 'bail|required|digits_between:1,9'
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
            'name.required' => trans('products.error_messages.name.required'),
            'name.min' => trans('products.error_messages.name.min'),
            'name.max' => trans('products.error_messages.name.max'),
            'description.required' => trans('products.error_messages.description.required'),
            'description.min' => trans('products.error_messages.description.min'),
            'description.max' => trans('products.error_messages.description.max'),
            'category.required' => trans('products.error_messages.category.required'),
            'category.in' => trans('products.error_messages.category.in'),
            'image.image' => trans('products.error_messages.image.image'),
            'price.required' => trans('products.error_messages.price.required'),
            'price.digits_between' => trans('products.error_messages.price.digits_between'),
            'stock.required' => trans('products.error_messages.stock.required'),
            'stock.digits_between' => trans('products.error_messages.stock.digits_between')
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'category' => $this->translateCategory($this->get('category'))
        ]);
    }

    /**
     * Assign a category to an index.
     *
     * @param string|null $idx
     * @return string|null
     */
    protected function translateCategory(?string $idx) : ?string
    {
        switch ($idx) {
            case '0':
                $idx = 'computer';
                break;
            case '1':
                $idx = 'smartphone';
                break;
            case '2':
                $idx = 'accessory';
                break;
            default:
                break;
        }
        return $idx;
    }
}
