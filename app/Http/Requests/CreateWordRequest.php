<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWordRequest extends FormRequest
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
            'word' => ['regex:/^$|^([a-zA-ZÜüÖöÄäß,()\s]*)$/'],
            //'word' => 'regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            //'email' => 'regex:/^.+@.+$/i',
            //'email' => 'regex:/^[a-zA-ZÜüÖöÄäß]$/i',
            'translate' => 'regex:/^([а-яА-ЯёЁ,()\s]*)$/u'
        ];
    }

    public function messages()
    {
        return [
            'word' => 'A word is required',
            'translate'  => 'A translate is required'
        ];
    }
}
