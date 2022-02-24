<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceStoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:32'],
            'photo' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:150'],
            'lat' => ['required', 'string', 'max:150'],
            'lon' => ['required', 'string', 'max:150'],
        ];
    }
}
