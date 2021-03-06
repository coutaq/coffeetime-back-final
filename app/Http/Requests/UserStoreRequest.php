<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'user' => ['required'],
            'name' => ['nullable', 'string', 'max:50'],
            'bio' => ['nullable', 'string', 'max:100'],
            'photo' => ['nullable', 'mimes:jpg,bmp,png'],
            'lat' => ['nullable'],
            'lon' => ['nullable'],
            'phone' => ['required''unique', 'max:11'],
            'isAnon' => ['nullable'],
        ];
    }
}