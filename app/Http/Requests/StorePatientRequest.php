<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    /**
     * Verifica se o usuário está autorizado a realizar esta requisição.
     */
    public function authorize(): bool
    {
        return true; // Autenticação já tratada no middleware das rotas
    }

    /**
     * Define as regras de validação para o cadastro de paciente.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:patients,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do paciente é obrigatório.',
            'email.unique' => 'Este e-mail já está cadastrado em outro paciente.',
            'email.email' => 'Informe um e-mail válido.',
            'birth_date.before' => 'A data de nascimento deve ser no passado.',
            'profile_image.image' => 'O arquivo enviado deve ser uma imagem válida.',
            'profile_image.max' => 'A imagem não pode ter mais que 2MB.',
        ];
    }
}
