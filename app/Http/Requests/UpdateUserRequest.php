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
            'isAdmin' => 'bail|nullable',
            'isEnabled' => 'bail|nullable',
            'name' => 'bail|required|min:3|max:40',
            'email' => 'bail|required|email|max:60|unique:users,email,'.$this->user->id,
            'password' => 'bail|nullable|min:8|max:20',
        ];
    }

    // protected function prepareForValidation()
    // {
    //     $this->merge([
    //         if(request()->has('isAdmin')){
    //             'isAdmin' => 1;
    //         }
    //         if(request()->has('isEnabled')){
    //             'isEnabled' => 1;
    //         }
    //         // $this->isPresentOrNot('isAdmin') => $this->onToTrueNullToFalse($this->request->all()['isAdmin']),
    //         // 'isEnabled' => $this->onToTrueNullToFalse($this->request->all()['isEnabled'])
    //     ]);
    // }

    // protected function isPresentOrNot(string $is) : string
    // {
    //     if (request()->has($is)) {
    //         return
    //     }
    //     return ;
    // }

    // protected function onToTrueNullToFalse(?string $value) : bool
    // {
    //     return $value;
    // }


    // public function messages()
    // {
    //     'name' => 'bail|required|min:3|max:40',
    //     'email' => 'bail|required|email|max:60|unique:users',
    //     'password' => 'bail|nullable|min:8|max:20',
    // }
}
