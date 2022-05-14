<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniversidadeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'alpha_two_code' => 'required|max:2|min:2',
            'country' => 'required',
            'domains' => 'required',
            'name' => 'required',
            'web_pages' => 'required|url',
        ];

    }

    public function messages(){
        return [
            'required' => 'Este campo é obrigatório.',
            'alpha_two_code.max' => 'Insira no máximo dois caracteres.',
            'alpha_two_code.min' => 'Insira no mínimo dois caracteres.',
            'web_pages.url' => 'Insira uma URL válida.'
        ];
    }
}
