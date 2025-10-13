<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Usuarios\UsuarioIndexRequest;
use App\Http\Requests\Usuarios\UsuarioStoreRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(UsuarioIndexRequest $request)
    {
        $data = $request->validated();
        $usuarios = Usuario::where($data)->get();

        return response()->json([
            'usuarios' => $usuarios
        ]);
    }

    public function store(UsuarioStoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make('123456789');

        Usuario::create($data);

        return response()->json([
            'message' => 'Usuário salvo com sucesso'
        ]);
    }
}
