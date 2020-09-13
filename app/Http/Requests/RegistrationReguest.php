<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationReguest extends FormRequest
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
            "first_name" => "required|regex:/^[A-Z]{1}[a-z]+$/",
            "last_name" => "required|regex:/^[A-Z]{1}[a-z]+$/",
            "email" => ["required", "regex:/\d*/", "regex:/[a-z]*/", "regex:/[!@#$%%^&*?]*/", "regex:/@(gmail\.|yahoo\.|ict\.edu\.)(com|rs)$/"],
            "reg_username" => "required|regex:/^[\w!@#$%^&*]+$/",
            "reg_password" => "required|regex:/\d+/|regex:/[a-z]+/|regex:/[!@#$%%^&*?]+/",
        ];
    }
}
