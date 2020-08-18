<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin;
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
            'delete' => 'nullable',
            'price' => 'bail|required|digits_between:4,9'
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
            'name.required' => __("Your product needs a name"),
            'name.min' => __("A good name has a minimum of 3 characters"),
            'name.max' => __("Do not exceed 80 characters and keep calm"),
            'description.required' => __("The description is very important, don't forget it"),
            'description.min' => __("Push yourself and get at least 10 characters"),
            'description.max' => __("Don't tell me your life, maximum 1000 characters for the description"),
            'category.required' => __("No cheating, choose one of the 3 categories"),
            'category.in' => __("No cheating, choose one of the 3 categories"),
            'image.image' => __("Verify that what you are uploading is an image"),
            'price.required' => __("The most important thing is missing"),
            'price.digits_between' => __("The minimum price is 4 digits and the maximum is 9"),
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
