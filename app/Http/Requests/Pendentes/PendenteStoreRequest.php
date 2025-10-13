<?php

namespace App\Http\Requests\Pendentes;

use Illuminate\Foundation\Http\FormRequest;

class PendenteStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'telegram_id' => ['required', 'string', 'exists:usuarios,telegram_id'],
            'mensagem_original' => ['required', 'string']
        ];
    }
}
