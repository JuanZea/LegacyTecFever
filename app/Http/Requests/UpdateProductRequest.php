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
    public function rules()
    {
        $rules = [
            'name' => 'bail|required|min:3|max:70',
            'description' => 'bail|required|min:40|max:10000',
            'category' => 'bail|required|in:computer,smartphone,accessory',
            'image' => 'nullable',
            'price' => 'bail|required|digits_between:4,9'
        ];

        // if($this->get('image')){
        //     $rules =array_merge($rules,['image' => 'mimes:jpg,jpeg,png']);
        // }
        return $rules;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'category' => $this->traslateCategory(request()['category'])
        ]);
    }

    protected function traslateCategory(?string $idx) : string
    {
        switch ($idx) {
            case 'computador':
                $idx = 'computer';
                break;
            case 'celular':
                $idx = 'smartphone';
                break;
            case 'accesorio':
                $idx = 'accessory';
                break;

            default:
                break;
        }
        return $idx;
    }
}
