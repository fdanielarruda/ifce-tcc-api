<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:usuarios,email'],
            'telegram_id' => ['required', 'string', 'unique:usuarios,telegram_id']
        ];
    }
}
