<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateProductRequest extends FormRequest
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
        return [
            'name' => 'bail|required|min:3|max:40',
            'description' => 'bail|required|min:40|max:1000',
            'category' => 'bail|required|in:computer,smartphone,accessory',
            'image' => 'bail|required',
            'price' => 'bail|required|min:4|max:9'
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
            'category' => $this->traslateCategory(request()['category'])
        ]);
    }

    protected function traslateCategory(?string $idx) : ?string
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
