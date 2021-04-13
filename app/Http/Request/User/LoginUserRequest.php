<?php


namespace App\Http\Request\User;


use App\Helpers\Requests\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    use FailedValidation;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => [
                'required',
                'min:8',
                'regex:/^.*(?=.{8,20})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
            ]
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Password must contain a capital, small letter and special character'
        ];
    }
}
