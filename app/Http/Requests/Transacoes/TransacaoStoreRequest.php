<?php

namespace App\Http\Requests\Transacoes;

use Illuminate\Foundation\Http\FormRequest;

class TransacaoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'telegram_id' => ['required', 'string', 'exists:usuarios,telegram_id'],
            'tipo' => ['required', 'in:credito,debito'],
            'categoria' => ['nullable'],
            'valor' => ['required', 'numeric'],
            'descricao' => ['nullable'],
            'mensagem_original' => ['required']
        ];
    }
}
