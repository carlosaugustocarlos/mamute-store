<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:255'],
            'store_id' => [
                'nullable',
                'integer',
                Rule::exists('stores', 'id')->where('user_id', $this->user()->id),
            ],
            'min_price' => ['nullable', 'numeric', 'min:0'],
            'max_price' => ['nullable', 'numeric', 'min:0', 'gte:min_price'],
            'in_stock' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'search.string' => 'A pesquisa deve ser um texto.',
            'search.max' => 'A pesquisa não pode ter mais de :max caracteres.',
            'store_id.integer' => 'Seleccione uma loja válida.',
            'store_id.exists' => 'A loja seleccionada é inválida.',
            'min_price.numeric' => 'O preço mínimo deve ser um número.',
            'min_price.min' => 'O preço mínimo não pode ser negativo.',
            'max_price.numeric' => 'O preço máximo deve ser um número.',
            'max_price.min' => 'O preço máximo não pode ser negativo.',
            'max_price.gte' => 'O preço máximo não pode ser menor que o preço mínimo.',
            'in_stock.boolean' => 'O filtro de stock é inválido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'search' => 'produto',
            'store_id' => 'loja',
            'min_price' => 'preço mínimo',
            'max_price' => 'preço máximo',
            'in_stock' => 'em stock',
        ];
    }
}
