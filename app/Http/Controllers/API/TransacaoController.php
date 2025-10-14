<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transacoes\TransacaoStoreRequest;
use App\Libraries\OpenAiLibrary;
use App\Models\Categoria;
use App\Models\Transacao;
use App\Models\Usuario;
use RuntimeException;

class TransacaoController extends Controller
{
    public function __construct(
        protected OpenAiLibrary $openAiLibrary
    ) {}

    public function index()
    {
        return response()->json([
            'transacoes' => Transacao::all()
        ]);
    }

    public function store(TransacaoStoreRequest $request)
    {
        $resultado = $this->openAiLibrary->converterLinguagemNaturalParaJson($request->mensagem_original);
        $campos_obrigatorios = ['tipo', 'categoria', 'valor', 'descricao'];

        foreach ($campos_obrigatorios as $campo_obrigatorio) {
            if (!isset($resultado[$campo_obrigatorio])) {
                throw new RuntimeException("Não foi possível interpretar a mensagem");
            }
        }

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
            'tipo' => $resultado['tipo'],
            'valor' => $resultado['valor'],
            'descricao' => $resultado['descricao'],
            'mensagem_original' => $request->mensagem_original
        ]);

        $transacao->load(['usuario', 'categoria']);

        return response()->json([
            'message' => 'Transação salva com sucesso',
            'transacao' => $transacao
        ]);
    }
}
