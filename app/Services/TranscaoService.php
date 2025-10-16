<?php

namespace App\Services;

use App\Libraries\OpenAiLibrary;
use App\Models\Categoria;
use App\Models\Transacao;
use App\Models\Usuario;
use Exception;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TranscaoService
{
    public function __construct(
        protected OpenAiLibrary $openAiLibrary
    ) {}

    public function list()
    {
        return Transacao::get();
    }

    public function create($data)
    {
        DB::beginTransaction();

        try {
            $result = $this->convertDataToResult($data);

            $user = Usuario::where('telegram_id', $data['telegram_id'])->first();

            $category = $this->defineCategory($result);

            $transacao = Transacao::create([
                'usuario_id' => $user->id,
                'categoria_id' => $category->id,
                'tipo' => $result['tipo'],
                'valor' => $result['valor'],
                'descricao' => $result['descricao'],
                'mensagem_original' => $data['mensagem_original']
            ]);

            $transacao->load(['usuario', 'categoria']);

            DB::commit();

            return $transacao;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e);
        }
    }

    public function delete(int $id)
    {
        $transaction = Transacao::findOrFail($id);
        $transaction->delete();
    }

    private function convertDataToResult(array $data)
    {
        $result = $this->openAiLibrary->naturalLanguageToJsonConverter($data['mensagem_original']);
        $required_fields = ['tipo', 'categoria', 'valor', 'descricao'];

        foreach ($required_fields as $field) {
            if (!isset($result[$field])) {
                throw new RuntimeException("Não foi possível interpretar a mensagem");
            }
        }

        return $result;
    }

    private function defineCategory(array $result)
    {
        $new_category = strtolower(trim($result['categoria'] ?? 'desconhecido'));

        $category = Categoria::where('titulo', $new_category)->first();

        if ($category?->exists()) {
            return $category;
        }

        return Categoria::create([
            'titulo' => $new_category
        ]);
    }
}
