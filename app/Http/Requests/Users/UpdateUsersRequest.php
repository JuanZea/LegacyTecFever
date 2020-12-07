<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('update_users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|min:2|max:25',
            'surname' => 'bail|nullable|min:2|max:25',
            'is_enabled' => 'nullable',
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
