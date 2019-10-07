<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetWordsRequest extends FormRequest
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
            'collections' => [
                'nullable',
                'array'
            ],
            'collections.*' => [
                'nullable',
                'distinct',
                'regex:/^([a-zA-ZÜüÖöÄäßа-яА-ЯёЁ0-9,()\s]*)$/',
                'max:100'
            ],
            'offset' => [
                'nullable',
                'integer',
                'between:1,1000'
            ],
            'limit' => [
                'nullable',
                'integer',
                'between:1,100'
            ]
        ];
    }

    public function messages()
    {
        return [
            'morpheme' => 'A word is required',
            'translate'  => 'A translate is required'
        ];
    }
}
