<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Usuarios\UsuarioDeleteRequest;
use App\Http\Requests\Usuarios\UsuarioIndexRequest;
use App\Http\Requests\Usuarios\UsuarioStoreRequest;
use App\Services\UsuarioService;

class UsuarioController extends Controller
{
    public function __construct(
        protected UsuarioService $service
    ) {}

    public function index(UsuarioIndexRequest $request)
    {
        $data = $request->validated();

        return response()->json([
            'usuarios' => $this->service->list($data)
        ]);
    }

    public function store(UsuarioStoreRequest $request)
    {
        $data = $request->validated();
        $user = $this->service->create($data);

        return response()->json([
            'message' => 'Usuário salvo com sucesso',
            'usuario' => $user
        ]);
    }

    public function delete(UsuarioDeleteRequest $request)
    {
        $data = $request->validated();
        $this->service->delete($data);

        return response()->json([
            'message' => 'Usuário deletado com sucesso'
        ]);
    }
}
