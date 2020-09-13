<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "username" => "required|regex:/^[\w!@#$%^&*]+$/",
            "password" => "required|regex:/\d+/|regex:/[a-z]+/|regex:/[!@#$%%^&*?]+/",
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Sifra mora sadrzati malo, veliko slovo, broj i specijalni znak',
        ];
    }
}
