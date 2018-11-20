<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class SaveService extends FormRequest
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
            'type_id' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|date_format:H:i',
            'range' => 'required',
        ];

    }

    public function attributes()
    {
        return [
        ];
    }
}
