<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|min:2|max:25',
            'surname' => 'bail|nullable|min:2|max:25',
            'document' => 'bail|string|nullable|min:4|max:25',
            'documentType' => 'bail|string|nullable|min:2|max:5',
            'mobile' => 'bail|numeric|nullable|digits_between: 8 , 15',
            'email' => 'bail|required|email|max:60|unique:users,email,'.$this->user->id,
            'password' => 'bail|nullable|min:8|max:20',
        ];
    }

    // public function messages()
    // {
    //     'name' => 'bail|required|min:3|max:40',
    //     'email' => 'bail|required|email|max:60|unique:users',
    //     'password' => 'bail|nullable|min:8|max:20',
    // }
}
