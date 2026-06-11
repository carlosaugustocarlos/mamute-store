<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $storeId = $this->route('store')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('stores', 'email')->ignore($storeId)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome da loja é obrigatório.',
            'name.string' => 'O nome da loja deve ser um texto.',
            'name.max' => 'O nome da loja não pode ter mais de :max caracteres.',
            'address.required' => 'O endereço da loja é obrigatório.',
            'address.string' => 'O endereço da loja deve ser um texto.',
            'address.max' => 'O endereço da loja não pode ter mais de :max caracteres.',
            'phone.required' => 'O telefone da loja é obrigatório.',
            'phone.string' => 'O telefone da loja deve ser um texto.',
            'phone.max' => 'O telefone da loja não pode ter mais de :max caracteres.',
            'email.required' => 'O email da loja é obrigatório.',
            'email.string' => 'O email da loja deve ser um texto.',
            'email.email' => 'Informe um email válido para a loja.',
            'email.max' => 'O email da loja não pode ter mais de :max caracteres.',
            'email.unique' => 'Este email já está associado a outra loja.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'address' => 'endereço',
            'phone' => 'telefone',
            'email' => 'email',
        ];
    }
}
