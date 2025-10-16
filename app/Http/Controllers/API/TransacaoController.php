<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transacoes\TransacaoStoreRequest;
use App\Services\TranscaoService;

class TransacaoController extends Controller
{
    public function __construct(
        protected TranscaoService $service
    ) {}

    public function index()
    {
        return response()->json([
            'transacoes' => $this->service->list()
        ]);
    }

    public function store(TransacaoStoreRequest $request)
    {
        $data = $request->validated();
        $transaction = $this->service->create($data);

        return response()->json([
            'mensagem' => 'Transação salva com sucesso',
            'transacao' => $transaction
        ]);
    }

    public function delete(int $id)
    {
        $this->service->delete($id);

        return response()->json([
            'mensagem' => 'Transação descartada com sucesso'
        ]);
    }
}
