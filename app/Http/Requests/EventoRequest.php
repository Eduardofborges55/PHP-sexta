<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'min:3'],
            'data_inicio' => [
                'required',
                Rule::date()->format('Y-m-d H:i:s')
            ],
            'data_fim' => [
                'required',
                Rule::date()->after('data_inicio')->format('Y-m-d H:i:s'),
                'after:data_inicio'
            ],
        ];
    }
}
