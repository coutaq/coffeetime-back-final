<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageUpdateRequest extends FormRequest
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
            'text' => ['required', 'string', 'max:150'],
            'to_id' => ['required', 'integer', 'exists:tos,id'],
            'from_id' => ['required'],
        ];
    }
}