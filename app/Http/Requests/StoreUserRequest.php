<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'address' => 'required|string|min:6',
            'cep' => 'required|string|min:6',
            'avatar' => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'name.min' => 'Nome muito curto',
            'email.required' => 'Email é obrigatório',
            'email.email' => 'Email inválido',
            'email.unique' => 'Esse email já existe',
            'password.required' => 'Senha obrigatória',
            'password.min' => 'Senha fraca',
            'address.required' => 'Email é obrigatório',
            'address.min' => 'Endereço muito curto',
            'cep.required' => 'CEP é obrigatório',
            'cep.min' => 'CEP muito curto'
        ];
    }
}
