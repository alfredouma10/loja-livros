<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->isAdmin;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'img' => 'required|url|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'isbn' => 'required|string|max:20',
            'publication_year' => 'required|integer|min:1|max:2026',
            'category_id' => 'required|exists:categories,id'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Introduz o título do livro.',
            'author.required' => 'Introduz o autor.',
            'description.required' => 'Introduz uma descrição.',
            'description.max' => 'A descrição não pode ultrapassar 255 caracteres.',
            'img.required' => 'Seleciona uma imagem.',
            'img.url' => 'O endereço da imagem é inválido.',
            'price.required' => 'Introduz o preço.',
            'price.numeric' => 'O preço deve ser numérico.',
            'price.min' => 'O preço não pode ser negativo.',
            'stock.required' => 'Introduz a quantidade em stock.',
            'stock.integer' => 'O stock deve ser um número inteiro.',
            'stock.min' => 'O stock não pode ser negativo.',
            'isbn.required' => 'Introduz o ISBN.',
            'publication_year.required' => 'Introduz o ano de publicação.',
            'category_id.required' => 'Seleciona uma categoria.',
            'category_id.exists' => 'A categoria selecionada não existe.'
        ];
    }
}
