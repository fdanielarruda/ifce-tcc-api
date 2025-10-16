<?php

namespace App\Services;

use App\Helpers\StringHelper;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioService
{
    public function list(array $filter)
    {
        return Usuario::where($filter)->get();
    }

    public function create(array $data)
    {
        $code = StringHelper::newCode(8);
        $data['password'] = Hash::make($code);

        $user = Usuario::create($data);

        $user['code'] = $code;

        return $user;
    }

    public function delete(array $data)
    {
        $user = Usuario::where('telegram_id', $data['telegram_id']);
        $user->delete();
    }
}
