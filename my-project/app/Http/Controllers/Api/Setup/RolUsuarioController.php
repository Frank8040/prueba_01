<?php

namespace App\Http\Controllers\Api\Setup;


use App\Models\Setup\RolUsuario;
use Illuminate\Http\Request;

class RolUsuarioController
{

    public function index(Request $request)
    {
        $lista = RolUsuario::lista_roles_asignados_a_usuario($request->input('usuario_id'));
        $listaAccesos = [];
        foreach ($lista as $key => $acceso) {
            $acceso->asignado = $acceso->asignado == '1' ? true : false;
            array_push($listaAccesos, $acceso);
        }
        return response()->json(['success' => true,
            'data' => $listaAccesos,
            'message' => 'lista de roles asignados a un usuario'], 200);

    }

    public function store(Request $request)
    {
        $input = $request->all();

        RolUsuario::where('usuario_id', $input['usuario_id'])->delete();
        foreach ($input['roles'] as $rol) {
            $rol_usuario = new RolUsuario();
            $rol_usuario->rol_id = $rol;
            $rol_usuario->usuario_id = $input['usuario_id'];
            $rol_usuario->save();
        }
        return response()->json(['success' => true,
            'data' => 'ok',
            'message' => 'Lista de roles asignados a un rol'], 200);
    }

}
