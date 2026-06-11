<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => [
                'required',
                'integer',
                Rule::exists('stores', 'id')->where('user_id', $this->user()->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'gt:0'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'store_id.required' => 'A loja do produto é obrigatória.',
            'store_id.integer' => 'Seleccione uma loja válida.',
            'store_id.exists' => 'A loja seleccionada é inválida.',
            'name.required' => 'O nome do produto é obrigatório.',
            'name.string' => 'O nome do produto deve ser um texto.',
            'name.max' => 'O nome do produto não pode ter mais de :max caracteres.',
            'description.string' => 'A descrição do produto deve ser um texto.',
            'price.required' => 'O preço do produto é obrigatório.',
            'price.numeric' => 'O preço do produto deve ser um número.',
            'price.gt' => 'O preço do produto deve ser maior que zero.',
            'stock_quantity.required' => 'A quantidade em stock é obrigatória.',
            'stock_quantity.integer' => 'A quantidade em stock deve ser um número inteiro.',
            'stock_quantity.min' => 'A quantidade em stock não pode ser negativa.',
            'photo.image' => 'A foto deve ser uma imagem válida.',
            'photo.mimes' => 'A foto deve estar num dos formatos: jpg, png ou webp.',
            'photo.max' => 'A foto não pode ter mais de 2 MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'store_id' => 'loja',
            'name' => 'nome',
            'description' => 'descrição',
            'price' => 'preço',
            'stock_quantity' => 'quantidade em stock',
            'photo' => 'foto',
        ];
    }
}
