<?php


namespace App\Http\Request\User;


use App\Helpers\Requests\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    use FailedValidation;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => [
                'required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
            ]
        ];
    }

    public function messages()
    {
        return [
            'username.unique' => 'User name already exist',
            'email.unique' => 'Email address already exist',
            'password.regex' => 'Password must contain a capital, small letter and special character'
        ];
    }
}
