<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pendentes\PendenteStoreRequest;
use App\Models\Pendente;
use App\Models\Usuario;

class PendenteController extends Controller
{
    public function store(PendenteStoreRequest $request)
    {
        $usuario = Usuario::where('telegram_id', $request->telegram_id)->first();

        $pendente = Pendente::create([
            'usuario_id' => $usuario->id,
            'mensagem_original' => $request->mensagem_original
        ]);

        return response()->json([
            'message' => 'Transação pendente salva com sucesso',
            'transacao_pendente' => $pendente
        ]);
    }
}
