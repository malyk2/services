<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class Profile extends FormRequest
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
            'name' => 'required|unique:users,name,'.auth()->id(),
            'email' => 'nullable|email',
            'pib' => 'required|max:255',
            'position' => 'nullable|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'логін',
            'email' => 'E-mail',
            'pib' => 'ПІБ',
            'position' => 'посада',
        ];
    }
}
