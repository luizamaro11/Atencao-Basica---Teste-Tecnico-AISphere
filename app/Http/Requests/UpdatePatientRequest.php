<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:patients,email,' . $this->route('patient')->id],
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
