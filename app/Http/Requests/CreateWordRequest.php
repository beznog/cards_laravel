<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'word_id' => [
                'nullable',
                'regex:/^([0-9]*)$/',
                'max:20'
            ],

            'morpheme' => [
                'required_without:translate',
                'nullable',
                'regex:/^([a-zA-ZÜüÖöÄäß,\-()\s]*)$/',
                'max:100'
            ],

            'translate' => [
                'required_without:morpheme',
                'nullable',
                'regex:/^([а-яА-ЯёЁ,\-()\s]*)$/u',
                'max:100'
            ],

            'word_type' => [
                'nullable',
                Rule::in(['noun','verb','adjective','other'])
            ],

            'article_type' => [
                'nullable',
                Rule::in(['der','die','das','die_plural'])
            ],

            'plural' => [
                'nullable',
                'regex:/^([a-zA-ZÜüÖöÄäß,()\s]*)$/',
                'max:100'
            ],

            'reflexive' => [
                'nullable',
                'boolean'
            ],

            'preposition' => [
                'nullable',
                Rule::in([
                    'Von+Dativ',
                    'Auf+Akkusativ',
                    'Für+Akkusativ',
                    'Mit+Dativ',
                    'An+Akkusativ',
                    'An+Dativ',
                    'Über+Akkusativ',
                    'Gegen+Akkusativ',
                    'Bei+Dativ',
                    'Um+Akkusativ',
                    'Aus+Dativ',
                    'Zu+Dativ',
                    'Vor+Dativ',
                    'Nach+Dativ',
                    'In+Akkusativ',
                    'In+Dativ',
                    'Als+Nominativ'
                ])
            ],

            'modal_verb' => [
                'nullable',
                Rule::in(['haben','sein'])
            ],

            'regularity' => [
                'nullable',
                Rule::in(['regular','irregular'])
            ],

            'prasens' => [
                'nullable',
                'regex:/^([a-zA-ZÜüÖöÄäß,()\s]*)$/',
                'max:100'
            ],

            'prateritum' => [
                'nullable',
                'regex:/^([a-zA-ZÜüÖöÄäß,()\s]*)$/',
                'max:100'
            ],

            'partizip' => [
                'nullable',
                'regex:/^([a-zA-ZÜüÖöÄäß,()\s]*)$/',
                'max:100'
            ],

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

            'picture' => [
                'nullable',
                //'url',
                //'regex:/^(http)(s?)(:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                //'url'   => ['regex' => '/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/'],
                'json',
                'max:400'
            ],

            'importance' => [
                'nullable',
                'integer',
                'between:1,5'
            ],

            'complexity' => [
                'nullable',
                'integer',
                'between:1,5'
            ],

            'knowledge' => [
                'nullable',
                'integer',
                'between:1,5'
            ],

            'examples' => [
                'nullable',
                'string',
                'max:200'
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
