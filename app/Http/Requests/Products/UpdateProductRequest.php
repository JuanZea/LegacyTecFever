<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('update_products');
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
            'is_enabled' => 'nullable',
            'delete' => 'nullable',
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
            'name.required' => trans('products.errors.name.required'),
            'name.min' => trans('products.errors.name.min'),
            'name.max' => trans('products.errors.name.max'),
            'description.required' => trans('products.errors.description.required'),
            'description.min' => trans('products.errors.description.min'),
            'description.max' => trans('products.errors.description.max'),
            'category.required' => trans('products.errors.category.required'),
            'category.in' => trans('products.errors.category.required'),
            'image.image' => trans('products.errors.image.image'),
            'price.required' => trans('products.errors.price.required'),
            'price.digits_between' => trans('products.errors.price.digits_between'),
            'stock.required' => trans('products.errors.stock.required'),
            'stock.digits_between' => trans('products.errors.stock.digits_between')
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
            'category' => $this->translateCategory(request()['category'])
        ]);
    }

    /**
     * Assign a category to an index.
     *
     * @param string|null $idx
     * @return string|null
     */
    protected function translateCategory(?string $idx) : string
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
