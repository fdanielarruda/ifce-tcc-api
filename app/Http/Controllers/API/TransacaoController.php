<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transacoes\TransacaoStoreRequest;
use App\Models\Categoria;
use App\Models\Transacao;
use App\Models\Usuario;

class TransacaoController extends Controller
{
    public function index()
    {
        return response()->json([
            'transacoes' => Transacao::all()
        ]);
    }

    public function store(TransacaoStoreRequest $request)
    {
        $usuario = Usuario::where('telegram_id', $request->telegram_id)->first();
        $nova_categoria = strtolower(trim($request->categoria ?? 'desconhecido'));

        $categoria = Categoria::where('titulo', $nova_categoria)->first();

        if (!$categoria?->exists()) {
            $categoria = Categoria::create([
                'titulo' => $nova_categoria
            ]);
        }

        $transacao = Transacao::create([
            'usuario_id' => $usuario->id,
            'categoria_id' => $categoria->id,
            'tipo' => $request->tipo ?? null,
            'valor' => $request->valor ?? null,
            'descricao' => $request->descricao ?? null,
            'mensagem_original' => $request->mensagem_original ?? null
        ]);

        $transacao->load(['usuario', 'categoria']);

        return response()->json([
            'message' => 'Transação salva com sucesso',
            'transacao' => $transacao
        ]);
    }
}
