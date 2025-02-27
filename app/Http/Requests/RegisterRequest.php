<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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

            'first_name' => 'bail|required|string|min:2|max:50',
            'last_name' => 'bail|required|string|min:2|max:50',

            'age' => 'required|integer|min:1|max:120',
            'address' => 'nullable|string|max:255',

            'email' => 'bail|required|email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'national_card_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
