<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->isAdmin;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',

            'img' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {

                    $category = Category::findOrFail(
                        $this->route('id')
                    );

                    if ($value !== $category->img &&
                        !filter_var($value, FILTER_VALIDATE_URL)) {

                        $fail('O endereço da imagem é inválido.');
                    }
                }
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Introduz o nome da categoria.',
            'name.max' => 'O nome é demasiado longo.',
            'description.required' => 'Introduz uma descrição.',
            'description.max' => 'A descrição é demasiado longa.',
            'img.required' => 'Seleciona uma imagem.'
        ];
    }
}